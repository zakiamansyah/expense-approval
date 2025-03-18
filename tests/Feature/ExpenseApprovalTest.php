<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Approver;
use App\Models\ApprovalStage;
use App\Models\Expense;
use App\Models\Approval;
use App\Models\Status;
class ExpenseApprovalTest extends TestCase {
    use RefreshDatabase;

    public function test_expense_approval_flow_with_endpoints() {
        $this->artisan('migrate:fresh');
        // Sediakan 3 approver (Ana, Ani, Ina)
        $approvers = [];
        foreach (['Ana', 'Ani', 'Ina'] as $name) {
            $response = $this->postJson('/api/v1/approvers', ['name' => $name]);
            $response->assertStatus(201);
            $approvers[] = $response->json('data');
        }

        // Sediakan 3 tahap approval
        foreach ($approvers as $approver) {
            $response = $this->postJson('/api/v1/approval-stages', ['approver_id' => $approver['id']]);
            $response->assertStatus(201);
        }

        // Sediakan 4 pengeluaran
        $expenses = [];
        for ($i = 1; $i <= 4; $i++) {
            $response = $this->postJson('/api/v1/expense', ['amount' => 1000 * $i, 'status_id' => 1]);
            $response->assertStatus(201);
            $expenses[] = $response->json('data');
        }

        // Pengeluaran pertama, disetujui semua approver
        foreach ($approvers as $approver) {
            $response = $this->postJson('/api/v1/approvals', [
                'expense_id' => $expenses[0]['id'],
                'approver_id' => $approvers[0]['id'],
                'status_id' => 2
            ]);
            $response->assertStatus(201);
        }
        $response = $this->getJson("/api/v1/expense/{$expenses[0]['id']}");
        $response->assertStatus(200);
        $this->assertEquals(2, $response->json('data.status_id'));

        // Pengeluaran kedua, disetujui dua approver
        foreach (array_slice($approvers, 0, 2) as $approver) {
            $response = $this->postJson('/api/v1/approvals', [
                'expense_id' => $expenses[1]['id'],
                'approver_id' => $approver['id'],
                'status_id' => 2
            ]);
            $response->assertStatus(201);
        }
        $response = $this->getJson("/api/v1/expense/{$expenses[1]['id']}");
        $response->assertStatus(200);
        $this->assertEquals(1, $response->json('data.status_id'));

        // Pengeluaran ketiga, disetujui satu approver
        $response = $this->postJson('/api/v1/approvals', [
            'expense_id' => $expenses[2]['id'],
            'approver_id' => $approvers[0]['id'],
            'status_id' => 2
        ]);
        $response->assertStatus(201);
        $response = $this->getJson("/api/v1/expense/{$expenses[2]['id']}");
        $response->assertStatus(200);
        $this->assertEquals(1, $response->json('data.status_id'));

        // Pengeluaran keempat, belum disetujui
        $response = $this->getJson("/api/v1/expense/{$expenses[3]['id']}");
        $response->assertStatus(200);
        $this->assertEquals(1, $response->json('data.status_id'));
    }
}