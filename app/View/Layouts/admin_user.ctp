<?php 
echo $this->Html->css("/admin/style"); 
echo $this->Session->flash();
echo $this->Session->flash('auth');
echo $content_for_layout;
echo $this->Html->script("fonction_admin.js");
echo $this->element('sql_dump'); 
?>