<!DOCTYPE html>
<html>
<head>
	<title>VCalender GENERATOR</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
	<style type="text/css">
		.link,.short-link,.bar-code{margin: 20px 0px;display: none;}
		.link h3,.short-link h3,.bar-code h3{color: #e67474;text-align: center;}
		.link pre,.short-link pre{height: 100px;padding: 40px 0px;}
        .bar-code{max-width: 200px;margin: 0px auto;}
        .bar-code img{width: 100%;height: 100%;}
        .add-more-btn,.add-more-btn:focus{background-color: #4d5ba5;border-color: #4d5ba5;}
        .add-more-btn:hover{background-color: #4d5ba5;border-color: #4d5ba5;opacity: 0.6;}
	</style>
</head>
<body>
<div class="container">
	<form action="vcalander_generator.php" method="GET">
		<h1>Basic Info</h1>
      <div class="form-group">
        <label>Calendar Name:</label>
        <input type="text" class="form-control" name="calendar_name"  placeholder="Calendar Name">
      </div>
      <div class="form-group">
        <label>Title:</label>
        <input type="text" class="form-control" name="title"  placeholder="Title">
      </div>
	  <div class="form-group">
	    <label>Description:</label>
	    <textarea class="form-control" name="description"  placeholder="Description.."></textarea>
	  </div>
	  <div class="form-group">
	    <label>All Day:</label>
        <label class="checkbox-inline">
          <input type="radio" name="all_day" class="all-day" value="yes" checked> Yes
        </label>
        <label class="checkbox-inline">
         <input type="radio" name="all_day" class="all-day" value="no">
          No
        </label>
        
	    
	  </div>
      <div class="form-group">
        <label>Date Start:</label>
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control datepicker" name="date_start"  placeholder="Start">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control timepicker hide" name="time_start"  placeholder="Time">
            </div>
        </div>
        
      </div>
      <div class="form-group">
        <label>Date End:</label>
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control datepicker" name="date_end"  placeholder="End">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control timepicker hide" name="time_end"  placeholder="Time">
            </div>
        </div>
      </div>
	  <div class="form-group">
	    <label>Status:</label>
        <select class="form-control" name="event_status" >
            <option>CONFIRMED</option>
            <option>TENTATIVE</option>
            <option>CANCELED</option>
        </select>
	  </div>

      <div class="form-group">
        <label>Location:</label>
        <input type="text" class="form-control" name="location"  placeholder="Location">
      </div>

      <div class="form-group">
        <label>Url :</label>
        <input type="text" class="form-control" name="url"  placeholder="Url">
      </div>

      
      <h4>Alerts :</h4>
      <div class="alert-div">
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" name="alert_value[]">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="alert_time[]">
                        <option value="M">minutes</option>
                        <option value="H">hour</option>
                        <option value="D">hour</option>
                        <option value="W">hour</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="alert_type[]">
                        <option value="b">before the event</option>
                        <option value="a">after the event</option>
                    </select>
                </div>

            </div>
        </div>
      </div>
      <div class="form-group">

              <a href="javascript:void(0);" class="btn btn-success add-more-btn" id="add_more">Add More <span class="glyphicon glyphicon-plus"></span></a>
      </div>
      <div class="form-group">



	  
	  
	 
    	  <input type="submit"  name="do" value="Icl" class="btn btn-default"/>
    	  <a href="javascript:void(0);" class="btn btn-success" id="generate">Generate Link</a>
          <div class="link">
            <h3>Long Link</h3>
            <pre></pre>
          </div>
          <div class="short-link">
            <h3>Short Link</h3>
            <pre></pre>
          </div>
    	  <div class="bar-code">
    		<h3>Bar Code</h3>
    	  	<?php echo '<img width="120px" height="120px" src="qrgen.php?url=test.php" />';?>
	  </div>
    </div>

      

	</form>
</div>






<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
	function copyToClipboard(element) {
	    var $temp = $("<input>");
	    $("body").append($temp);
	    $temp.val($(element).text()).select();
	    document.execCommand("copy");
	    $temp.remove();
	}
	jQuery(function($){
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            pickTime: false
        });
        $('.timepicker').datetimepicker({
            format: 'HH:mm:00',
            pickDate: false,
            pickSeconds: false,
            pick12HourFormat: false
        });
        $(".all-day").on("change",function(e){
            if($(".all-day:checked").val()=="yes"){
               $(".timepicker").addClass("hide"); 
            }else{
                $(".timepicker").removeClass("hide");
            }
        });
        $("#add_more").on("click",function(e){
            e.preventDefault();
            var str = '<div class="form-group">';
                str+= '<div class="row">';
                str+= '<div class="col-md-2">';
                str+='<input type="text" class="form-control" name="alert_value[]">';
                str+='</div>';
                str+='<div class="col-md-3">';
                str+='<select class="form-control" name="alert_time[]">';
                str+='<option value="M">minutes</option>';
                str+='<option value="H">hour</option>';
                str+='<option value="D">hour</option>';
                str+='<option value="W">hour</option>';
                str+='</select>';
                str+='</div>';
                str+='<div class="col-md-4">';
                str+='<select class="form-control" name="alert_type[]">';
                str+='<option value="b">before the event</option>';
                str+='<option value="a">after the event</option>';
                str+='</select>';
                str+='</div>';
                str+='</div>';
                str+='</div>';
            $(".alert-div").append(str);

        })
		var url ="http://localhost/v-calander/";
		url=url+"vcalander_generator.php?do=icl&";
		$("#generate").on("click",function(e){
			e.preventDefault();
			$form=$(this).closest('form');
			new_url=url+$form.serialize();
			$(".link pre").html(new_url);
			$(".link").fadeIn();
			//copyToClipboard(".link pre");
            $.ajax({
                url: 'short_url.php',
                type: 'post',
                dataType: 'html',
                data: {nurl: new_url},
            })
            .done(function(data) {
                var bcode="qrgen.php?url="+data;

                $(".bar-code img").attr("src",bcode);
                $(".short-link pre").html(data);
                $(".short-link").fadeIn();
                $(".bar-code").fadeIn();
                copyToClipboard(".short-link pre");
                //console.log(data);
            })
            .fail(function() {
                console.log("error");
            });
            

		});

	});
</script>
</body>
</html>
