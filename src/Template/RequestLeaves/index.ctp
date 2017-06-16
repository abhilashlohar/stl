<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Request Leave'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Leave Types'), ['controller' => 'LeaveTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Leave Type'), ['controller' => 'LeaveTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requestLeaves index large-9 medium-8 columns content">
    <h3><?= __('Request Leaves') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('employee_id') ?></th>
                <th><?= $this->Paginator->sort('leave_type_id') ?></th>
                <th><?= $this->Paginator->sort('leave_from') ?></th>
                <th><?= $this->Paginator->sort('leave_to') ?></th>
                <th><?= $this->Paginator->sort('no_of_days') ?></th>
                <th><?= $this->Paginator->sort('reason') ?></th>
                <th><?= $this->Paginator->sort('request_date') ?></th>
                <th><?= $this->Paginator->sort('leave_status') ?></th>
                <th><?= $this->Paginator->sort('remarks') ?></th>
                <th><?= $this->Paginator->sort('half_day') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requestLeaves as $requestLeave): ?>
            <tr>
                <td><?= $this->Number->format($requestLeave->id) ?></td>
                <td><?= $requestLeave->has('employee') ? $this->Html->link($requestLeave->employee->name, ['controller' => 'Employees', 'action' => 'view', $requestLeave->employee->id]) : '' ?></td>
                <td><?= $requestLeave->has('leave_type') ? $this->Html->link($requestLeave->leave_type->leave_name, ['controller' => 'LeaveTypes', 'action' => 'view', $requestLeave->leave_type->id]) : '' ?></td>
                <td><?= h($requestLeave->leave_from) ?></td>
                <td><?= h($requestLeave->leave_to) ?></td>
                <td><?= $this->Number->format($requestLeave->no_of_days) ?></td>
                <td><?= h($requestLeave->reason) ?></td>
                <td><?= $this->Number->format($requestLeave->request_date) ?></td>
                <td><?= h($requestLeave->leave_status) ?></td>
                <td><?= h($requestLeave->remarks) ?></td>
                <td><?= h($requestLeave->half_day) ?></td>
                <td><?= $requestLeave->has('company') ? $this->Html->link($requestLeave->company->name, ['controller' => 'Companies', 'action' => 'view', $requestLeave->company->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $requestLeave->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $requestLeave->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $requestLeave->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestLeave->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
