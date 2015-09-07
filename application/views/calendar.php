<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo lang('website_title'); ?> | <?php echo lang('calendar_title'); ?> </title>
     <?php echo $this->load->view('head'); ?>
	 <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print" />
	 <!-- daterange picker -->
     <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  
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
            Calendar
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
		  
		<?php if($this->authorization->is_permitted('manage_calendar')){ ?>
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">Dentist</h4>
                </div>
                <div class="box-body">
                  <!-- dentist -->
				  <div style="background-color:#000;">
                        <ul class="contacts-list">
                          <li>
                            <a href="#">
                              <img class="contacts-list-img" src="dist/img/user1-128x128.jpg">
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                                <span class="contacts-list-msg">Available</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href="#">
                              <img class="contacts-list-img" src="dist/img/user7-128x128.jpg">
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Sarah Doe
                                  <small class="contacts-list-date pull-right">2/23/2015</small>
                                </span>
                                <span class="contacts-list-msg">Available</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href="#">
                              <img class="contacts-list-img" src="dist/img/user3-128x128.jpg">
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nadia Jolie
                                  <small class="contacts-list-date pull-right">2/20/2015</small>
                                </span>
                                <span class="contacts-list-msg">Available</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href="#">
                              <img class="contacts-list-img" src="dist/img/user5-128x128.jpg">
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nora S. Vans
                                  <small class="contacts-list-date pull-right">2/10/2015</small>
                                </span>
                                <span class="contacts-list-msg">On leave</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href="#">
                              <img class="contacts-list-img" src="dist/img/user6-128x128.jpg">
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  John K.
                                  <small class="contacts-list-date pull-right">1/27/2015</small>
                                </span>
                                <span class="contacts-list-msg">Available</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href="#">
                              <img class="contacts-list-img" src="dist/img/user8-128x128.jpg">
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Kenneth M.
                                  <small class="contacts-list-date pull-right">1/4/2015</small>
                                </span>
                                <span class="contacts-list-msg">On Leave</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                        </ul><!-- /.contatcts-list -->
                      </div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
		<?php } ?>
		
            <div class="<?php if($this->authorization->is_permitted('manage_calendar')){ ?>col-md-9<?php }else{ ?>col-md-12<?php } ?>">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  	 
		  <!--Event Modal-->
		  <div class="example-modal">
            <div id="eventModal" class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#eventModal').hide();"><span aria-hidden="true" >×</span></button>
                    <h4 class="modal-title">Modal Default</h4>
                  </div>
                  <form class="form-horizontal">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Id</label>
                      <div class="col-sm-10">
                        <input class="form-control" placeholder="id" name="id" type="text">
                      </div>
                    </div> 
					<div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="title" placeholder="Title" name="title" type="text">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="description" class="col-sm-2 control-label">Desciption</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="description" placeholder="Description" name="description"  type="text">
                      </div>
                    </div>
                   <div class="form-group">
                    <label for="datrange" class="col-sm-2 control-label" >Date and time range</label>
                      <div class="col-sm-10">
					 <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input class="form-control pull-right active" id="reservationtime" name="reservationtime" type="text">
                    </div><!-- /.input group -->
                    </div>
                  </div>
                  </div><!-- /.box-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="$('#eventModal').hide();">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div><!-- /.box-footer -->
                </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
		  <!--/.Event Modal-->
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
		
			  
			  
       <?php echo $this->load->view('footer'); ?>

    </div><!-- ./wrapper -->
	<?php echo $this->load->view('footer_js'); ?>
    
    <!-- Page specific script -->
    <script type="text/javascript">
	
	 $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 5, format: 'DD/MM/YYYY h:mm A'});
	 
      $(function () {

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          //Get events
          events: '<?php echo base_url()."calendar/events";?>',
          editable: false,
          droppable: false, // this allows things to be dropped onto the calendar !!!
		  dayClick: function(date, jsEvent, view) {

				$('#eventModal [name="id"]').val("");
				$('#eventModal [name="title"]').val("");
				$('#eventModal [name="reservationtime"]').val(date.format("DD/MM/YYYY")+" 12:00 AM - "+date.format("DD/MM/YYYY")+" 11:59 PM");
				$('#eventModal [name="reservationtime"]').daterangepicker({startDate: date.format("DD/MM/YYYY")+" 12:00 AM", endDate: date.format("DD/MM/YYYY")+" 11:59 PM", timePicker: true, timePickerIncrement: 5, format: 'DD/MM/YYYY h:mm A'});			
				$('.modal-title').html("Add New Event");
				$('#eventModal').show();
				
		  },
		  eventClick: function(calEvent, jsEvent, view) {
			  
				$('#eventModal [name="id"]').val(calEvent.id);
				$('#eventModal [name="title"]').val(calEvent.title);
				$('#eventModal [name="reservationtime"]').val(calEvent.start.format("DD/MM/YYYY h:mm A")+" - "+calEvent.end.format("DD/MM/YYYY h:mm A"));
				$('#eventModal [name="reservationtime"]').daterangepicker({startDate: calEvent.start.format("DD/MM/YYYY h:mm A"), endDate: calEvent.end.format("DD/MM/YYYY h:mm A"), timePicker: true, timePickerIncrement: 5, format: 'DD/MM/YYYY h:mm A'});			
				$('.modal-title').html("Edit Event");
				$('#eventModal').show();

		  }
        });

       
			
      });
	  
	  function addEvent(){
		  
		  $('#calendar').fullCalendar( 'refetchEvents' );
	  }
    </script>
  </body>
</html>
