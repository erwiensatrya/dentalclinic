<!DOCTYPE html>
<html>
  <head>
    <title><?php echo lang('website_title'); ?> | <?php echo lang('mailbox_title'); ?></title>
   
    <?php echo $this->load->view('head'); ?>
   
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
	
	<?php echo $this->load->view('header'); ?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php echo $this->load->view('aside_l'); ?>
	<!-- /.sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo lang('mailbox_title'); ?>
            <small><?php echo (isset($mailboxInfo['total'])) ? $mailboxInfo['total']:""; ?> messages</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo lang('mailbox_title'); ?></li>
          </ol>
        </section>
		
		<?php if(isset($error)){ ?>
		<div class="pad margin no-print">
          <div class="alert alert-danger alert-dismissable" style="margin-bottom: 0!important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Alert!</h4>
			<?php echo $error; ?>
		</div>
		</div>
		<?php } ?>	
		
        <!-- Main content -->
        <section class="content">		
          <div class="row">
            <div class="col-md-3">
              <a onclick="$('#mailbox_email').hide();$('#read_email').hide();$('#inbox_menu').removeClass('active');$('#new_email').show();" class="btn btn-primary btn-block margin-bottom">Compose</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li id="inbox_menu" class="active"><a href="#" onclick="$('#read_email').hide();$('#new_email').hide();$('#mailbox_email').show();$('#inbox_menu').addClass('active');"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo ((isset($mailboxInfo['unread'])) && ($mailboxInfo['unread']>0)) ? $mailboxInfo['unread'] :""; ?></span></a></li>
                    <li id="sent_menu" class=""><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                    <li id="draft_menu" class=""><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li id="trash_menu" class=""><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Labels</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-star text-yellow"></i> Important</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
			
			<!-- Mailbox Email -->
            <div class="col-md-9" id="mailbox_email" style="<?php if(isset($compose)){ ?>display:none;<?php } ?>">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail" />
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-<?php echo (isset($counter)) ? $counter:""; ?>/<?php echo (isset($mailboxInfo['total'])) ? $mailboxInfo['total']:""; ?>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
					  <?php if(isset($mail)){
						  foreach ($mail as $idx => $value){
					  ?>
                        <tr id="mail-<?php echo $idx; ?>">
                          <td><input type="checkbox" /></td>
                          <td class="mailbox-star"><a href="#" onclick="setFlag('#mail-<?php echo $idx; ?>')" mailbox="<?php echo $value['mailbox']; ?>" uidvalidity="<?php echo $value['uidvalidity']; ?>" id_msg="<?php echo $value['id']; ?>" date="<?php echo urlencode($value['date']); ?>"><i class="fa fa-star<?php if(!$value['flagged']){ echo "-o"; } ?> text-yellow" ></i></a></td>
                          <td class="mailbox-name"><a href="#" onclick="readMail('#mail-<?php echo $idx; ?>');" mailbox="<?php echo $value['mailbox']; ?>" uidvalidity="<?php echo $value['uidvalidity']; ?>" id_msg="<?php echo $value['id']; ?>" date="<?php echo urlencode($value['date']); ?>"><?php echo $value['from']; ?></a></td>
                          <td class="mailbox-subject"><?php if($value['unseen']){ echo '<b>'.$value['subject'].'</b>'; }else{ echo $value['subject']; } ?></td>
                          <td class="mailbox-attachment"><?php if($value['attachments']>0){ ?><i class="fa fa-paperclip"></i> <?php echo $value['attachments']; } ?></td>
                          <td class="mailbox-date"><?php echo $value['udate']; ?></td>
                        </tr>
					  <?php }
					  } ?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-<?php echo (isset($counter)) ? $counter:""; ?>/<?php echo (isset($mailboxInfo['total'])) ? $mailboxInfo['total']:""; ?>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
			<!-- End Mailbox Inbox -->
			
			<?php echo form_open(uri_string(),array('enctype'=>'multipart/form-data')); ?>
			<!-- New Email -->
			<div class="col-md-9" id="new_email" style="<?php if(!isset($compose)){ ?>display:none;<?php } ?>">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose New Message</h3>
                </div><!-- /.box-header -->
				<input name="id_email" value="" />
                <div class="box-body">
                  <div class="form-group <?php echo (form_error('mail_to')) ? 'has-error' : ''; ?>">
				  
						<?php if (form_error('mail_to'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mail_to',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('mail_to'),'class'=>'form-control' ,'name' => 'mail_to', 'id' => 'mail_to', 'value' => set_value('mail_to') ? set_value('mail_to') : (isset($mail->mail_to) ? $mail->mail_to : ''))); ?>
	
                  </div>
                  <div class="form-group <?php echo (form_error('mail_subject')) ? 'has-error' : ''; ?>">
						
						<?php if (form_error('mail_subject'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mail_subject',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('mail_subject'),'class'=>'form-control' ,'name' => 'mail_subject', 'id' => 'mail_subject', 'value' => set_value('mail_subject') ? set_value('mail_subject') : (isset($mail->mail_subject) ? $mail->mail_subject : ''))); ?>
	
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                    </textarea>
                  </div>
                  <div class="form-group <?php echo (form_error('attachment')) ? 'has-error' : ''; ?>">
				  
						<?php if (form_error('attachment'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('attachment',' ',' ');
							?>
						</label>
						<?php } ?>
										
					<div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Attachment
                      <input type="file" name="attachment[]" multiple="" />
                    </div>
                    <p class="help-block">Max. 20MB</p>
					
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-default" name="draft_email"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="submit" class="btn btn-primary" name="send_email" value="send_email" id="send_email"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
			<!--End Compose New Message-->
			<?php echo form_close(); ?>
			
			<!--Read Message-->
			<div class="col-md-9" id="read_email" style="display:none;" >
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Read Mail</h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
                				
				<div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3 id="read_subject"></h3>
                    <h5 id="read_from">From: <span class="mailbox-read-time pull-right" id= "read_date"> </span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message" id="read_message">
                   
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
				
                <div class="box-footer">
                  <ul class="mailbox-attachments clearfix" style="display:none;">
                   <!-- Dynamicaly add attachment -->
                  </ul>
                </div><!-- /.box-footer -->
				
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                    <button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                  </div>
                  <button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                  <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div><!-- /.box-footer -->
				<div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
			<!-- End Read Email-->
			
			
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

	<?php echo $this->load->view('footer'); ?>	
      
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	<?php echo $this->load->view('footer_js'); ?>
    <!-- Page Script -->
    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
	  
	  $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
	  //Read Email
	  
	  function readMail(id){
		  
		  $('#mailbox_email').hide();
		  $('#inbox_menu').removeClass('active');
		  $('#new_email').hide();
		  $('#read_email').show();
		  		  
		  $('#read_subject').html('');
		  $('#read_message').html('<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>');
		  $('#read_from').html('From:');
		  $('#read_date').html('');
		  $('.mailbox-attachments').html('');
		  $('#read_email .overlay').show();
		  //$(id+" .mailbox-name a").attr('date')
		  //$(id+" .mailbox-name a").attr('subject')
			
			
		$.getJSON("<?php echo base_url()."mail/readmail/?"; ?>id="+$(id+" .mailbox-name a").attr('id_msg')+"&mailbox="+$(id+" .mailbox-name a").attr('mailbox')+"&date="+$(id+" .mailbox-name a").attr('date'), function(data) {

			$('#read_subject').html(data.subject);
			$('#read_from').html("From: "+data.from);
			$('#read_date').html(data.udate);			
			$('#read_message').html($('<div/>').html(data.message).text());
			$('#read_email .overlay').hide();
						
			//if(data.attachments.length === 0){
				$('#read_email .mailbox-attachments').show();
				$.each(data.attachments, function(i, item) {
					//alert(item.name);
					if(item.name != ''){
						$('.mailbox-attachments').append('<li><span class="mailbox-attachment-icon"><i class="fa '+item.icon+'"></i></span><div class="mailbox-attachment-info" style="word-wrap: break-word;"><a target="_blank" href="<?php echo base_url()."mail/downloadAttachment/"; ?>?id='+$(id+" .mailbox-name a").attr('id_msg')+'&mailbox='+$(id+" .mailbox-name a").attr('mailbox')+'&date='+$(id+" .mailbox-name a").attr('date')+'&file='+item.name+'" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> '+item.name+'</a><span class="mailbox-attachment-size">'+item.size+'<a href="<?php echo base_url()."mail/downloadAttachment/"; ?>'+id+'" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a></span></div></li>');	
					}
				});
			//}
			//if(data.error){ alert(data.error); }
		});
	  }
	  
	  function setFlag(id){
		$.getJSON("<?php echo base_url()."mail/setflag/?"; ?>id="+$(id+" .mailbox-name a").attr('id_msg')+"&mailbox="+$(id+" .mailbox-name a").attr('mailbox')+"&date="+$(id+" .mailbox-star a").attr('date')+"&flag=Flagged&action="+$(id+" .mailbox-star a i").hasClass('fa-star-o'), function(data) {
			if(data.error){ alert(data.error); }
		});
	  }
	  
    </script>
    
  </body>
</html>
