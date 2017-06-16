<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeHierarchiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeHierarchiesTable Test Case
 */
class EmployeeHierarchiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeHierarchiesTable
     */
    public $EmployeeHierarchies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee_hierarchies',
        'app.employees',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.quotations',
        'app.financial_years',
        'app.financial_months',
        'app.receipt_vouchers',
        'app.vouchers_references',
        'app.voucher_ledger_accounts',
        'app.ledgers',
        'app.reference_details',
        'app.payment_vouchers',
        'app.invoice_bookings',
        'app.grns',
        'app.purchase_order_rows',
        'app.purchase_orders',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.invoice_rows',
        'app.item_serialnumbers',
        'app.invoices',
        'app.customer_groups',
        'app.item_ledgers',
        'app.inventory_vouchers',
        'app.sales_order_rows',
        'app.sales_orders',
        'app.filenames',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.creator',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.logins',
        'app.user_rights',
        'app.pages',
        'app.user_logs',
        'app.employee_companies',
        'app.editor',
        'app.sale_taxes',
        'app.sale_tax_companies',
        'app.job_cards',
        'app.job_card_rows',
        'app.inventory_voucher_rows',
        'app.item_serial_numbers',
        'app.inventory_transfer_vouchers',
        'app.inventory_transfer_voucher_rows',
        'app.purchase_returns',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.vendor_companies',
        'app.purchase_return_rows',
        'app.reference_balances',
        'app.challans',
        'app.challan_rows',
        'app.sale_returns',
        'app.account_references',
        'app.sale_return_rows',
        'app.invoice_breakups',
        'app.quotation_rows',
        'app.material_indent_rows',
        'app.material_indents',
        'app.grn_rows',
        'app.invoice_booking_rows',
        'app.paid_tos',
        'app.bank_cashes',
        'app.payment_breakups',
        'app.credit_notes',
        'app.customer_suppilers',
        'app.heads',
        'app.credit_notes_rows',
        'app.received_froms',
        'app.receipt_breakups',
        'app.quotation_close_reasons',
        'app.customer_contacts',
        'app.customer_companies',
        'app.customer_segs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmployeeHierarchies') ? [] : ['className' => 'App\Model\Table\EmployeeHierarchiesTable'];
        $this->EmployeeHierarchies = TableRegistry::get('EmployeeHierarchies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeeHierarchies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
