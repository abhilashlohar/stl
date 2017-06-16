<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $requestLeave->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $requestLeave->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Request Leaves'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Leave Types'), ['controller' => 'LeaveTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Leave Type'), ['controller' => 'LeaveTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requestLeaves form large-9 medium-8 columns content">
    <?= $this->Form->create($requestLeave) ?>
    <fieldset>
        <legend><?= __('Edit Request Leave') ?></legend>
        <?php
            echo $this->Form->input('employee_id', ['options' => $employees]);
            echo $this->Form->input('leave_type_id', ['options' => $leaveTypes]);
            echo $this->Form->input('leave_from');
            echo $this->Form->input('leave_to');
            echo $this->Form->input('no_of_days');
            echo $this->Form->input('reason');
            echo $this->Form->input('request_date');
            echo $this->Form->input('leave_status');
            echo $this->Form->input('remarks');
            echo $this->Form->input('half_day');
            echo $this->Form->input('company_id', ['options' => $companies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
