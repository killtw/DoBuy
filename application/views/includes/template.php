<? if($action != 'ajax') $this->load->view('includes/header'); ?>

<div id="main" <? if($action != 'ajax') echo 'class="main"'; ?>>
	<? if($action != 'ajax') $this->load->view('head_view'); ?>
	<? $this->load->view($main); ?>
</div>

<? if($action != 'ajax') $this->load->view('includes/footer'); ?>
