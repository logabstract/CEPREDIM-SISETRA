	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap-datepicker.min.js');?>"> </script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap-datepicker.es.min.js');?>"> </script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap-filestyle.min.js');?>"></script>

  	<script type="text/javascript">
	    $(document).ready(function () {


        var now = new Date();
        console.log('date is',now);        


      	$('#tra_fecha_orden').datepicker({
      	  	format: 'dd-mm-yyyy',
          	language: 'es',
            startDate: now,
          	autoclose: true
      	});	    	

      	$('#gui_fecha').datepicker({
      	  	format: 'dd-mm-yyyy',
          	language: 'es',
            startDate: now,
          	autoclose: true
      	});		

      	$('#tra_com_fecha').datepicker({
      	  	format: 'dd-mm-yyyy',
          	language: 'es',
            startDate: now,
          	autoclose: true
      	});	

		    
		    $('#tra_fecha_produccion').datepicker({
  				format: 'dd-mm-yyyy',
  				language: 'es',
  				startDate: now,
          autoclose: true
		    });  

        // $('#tra_fecha_produccion').datepicker({
        //   format: 'dd-mm-yyyy',
        //   language: 'es',
        //   startDate: now,
        // }).on('changeDate', function(ev){
        //   var newDate = new Date(ev.date);
        //   newDate.setDate(newDate.getDate() + 1);
        //   $('#tra_fecha_produccion').datepicker("hide");
        //   $('#tra_fecha_entrega').datepicker("setStartDate", newDate);
        //   if (ev.date.valueOf() > $('#tra_fecha_entrega').datepicker("getDate")) {$('#tra_fecha_entrega').val("")};
        // });        

		    $('#tra_fecha_entrega').datepicker({
  				format: 'dd-mm-yyyy',
  				language: 'es', 
          startDate: now,
  				autoclose: true
		    });		

	      });
	  </script>
  </body>
</html>