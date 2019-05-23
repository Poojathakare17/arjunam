<!DOCTYPE html>
<html>
<title><?php echo $title;?></title>

<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets').'/';?>img/favicon.ico">
    <!--Let browser know website is optimized for mobile-->
    <link rel="stylesheet" href="<?php echo base_url('assets').'/';?>bower_components/Materialize/dist/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url('assets').'/';?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('assets').'/';?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets').'/';?>css/jquery.fancybox.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets').'/';?>css/linearfonts.css">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> -->
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets').'/';?>js/Moment.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url('assets').'/';?>js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" />
    <script src="<?php echo base_url('assets').'/';?>bower_components/Materialize/dist/js/materialize.min.js"></script>
 

    
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script> -->
    
    <!-- <script src="<?php echo base_url('assets').'/';?>js/chintantable.js"></script> -->
    <script src="<?php echo base_url('assets').'/';?>js/jquery.fancybox.pack.js"></script>
    <script src="<?php echo base_url('assets').'/';?>tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url('assets').'/';?>js/formInit.js"></script>


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

	<header>
			<nav class="blue darken-4">
			<?php   $menus = $this->menu_model->viewmenus(); 	  ?>
			<?php   $ProjectTitle = $this->menu_model->getProjectTitle(); 	  ?>
			<ul id="slide-out" class="side-nav fixed">
			<li class="sub-menu logo">
                    		<?php   if($ProjectTitle->name !="") 	{ ?>
						<a id="logo-container" href="<?php echo site_url(); ?>" class="align-center blue-text text-darken-4" style="font-size: 28px;">
                           
                            <span style="font-weight: 400;"><?php echo $ProjectTitle->name ?></span>
						</a>
						<?php }
                    else if($ProjectTitle->logo !=""){
                    ?>
                    <div class="logo">
							<img src="<?php echo base_url('uploads').'/'.$ProjectTitle->logo; ?>" width="40" style="margin-top: 15px;
    margin-left: 15px; margin-right: 5px;">
						</div>
						
						<?php }?>

                    </li>
                    <?php
				foreach($menus as $row)
				{
					$pieces = explode("/", $row->url);
					$page2="";
					if(empty($pieces) || !isset($pieces[1]))
					{
						$page2="";
					}
					else
						$page2=$pieces[1];
					$submenus = $this->menu_model->getsubmenus($row->id);
					?>
                        <li class="<?php if($page==$page2 || $page == strtolower($row->name)) { echo 'active'; } //echo $page2;
					if(count($submenus > 0))
					{
						$pages =  $this->menu_model->getpages($row->id);
						//echo $page2;
						//print_r($pages);
						echo ' sub-menu';
						if(in_array($page, $pages,TRUE))
							echo ' active';
					}
					?> ">
                            <a class="waves-effect waves-default" href="<?php
						if($row->url == " ")
							echo "javascript:; ";
						else if($row->linktype == 1) echo site_url($row->url);
						else if($row->linktype == 2) echo base_url($row->url);
						else if($row->linktype == 3) echo ($row->url);
						?>" <?php if($row->linktype == 3) echo ""; ?>>
							<?php
							if($row->icon != "")
							{  ?>
								<i class="<?php echo $row->icon; ?>"></i>
					<?php	}
							?>
							<span><?php echo $row->name;  ?></span>
							<span class="arrow"></span>
						</a>
                            <?php
						if(count($submenus) > 0)
						{  ?>
                                <ul class="sub">
                                    <?php
								foreach($submenus as $row2)
								{
									$pieces2 = explode("/", $row2->url);

									if(empty($pieces2) || !isset($pieces2[1]))
									{
										$page3="";
									}
									else
										$page3=$pieces2[1];
								?>
                                    <li class="<?php if($page==$page3 || $page == strtolower($row2->name))  ?> nopadding">
                                            <a class="waves-effect waves-default" href="<?php
											if($row2->url == " ")
												echo "javascript:; ";
											else if($row2->linktype == 1) echo site_url($row2->url);
											else if($row2->linktype == 2) echo base_url($row2->url);
											else if($row2->linktype == 3) echo ($row2->url);
										?>">
                                                <?php
											if($row2->icon != "")
											{  ?>
                                                    <i class="<?php echo $row2->icon; ?>" <?php if($row2->linktype == 3) echo ""; ?>></i>
                                                    <?php	}
											?>
                                                        <?php echo $row2->name;  ?>
                                            </a>
                                        </li>
                                        <?php	}
								?>
                                </ul>
                                <?php	}
						?>
                        </li>
                        <?php }
				?>
                </ul>

                <div class="row">
                    <div class="col s6">
                        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                    </div>
                    <div class="col s6 offset-l6 m6 l6 search">
                        <a href="<?php echo site_url('login/logout'); ?>" class="waves-effect waves-light btn red" style="float:right; margin: 7px 0 0;"><i class="material-icons left">power_settings_new</i> Logout</a>
                    </div>
                </div>
        </nav>


    </header>
    <main>

<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Periodic Jobs</h4>
</div>

  <div class="pad-left-15">
    <div class="col s12 m12">
      <div class="right">
      <button class="btn btn-primary waves-effect waves-light  blue darken-4" id="create-invoice" >Create Invoice</button>
        <!-- <button class="waves-effect waves-light btn deep-orange lighten-3 " style="color:black;" onclick="changestatus(this.id)" id="1" >Open</button>
        <button class="waves-effect waves-light btn lime accent-2" style="color:black;" onclick="changestatus(this.id)" id="2" >Partial</button>
        <button class="waves-effect waves-light btn green accent-1" style="color:black;" onclick="changestatus(this.id)" id="3" >Close</button> -->
      </div>
    </div>
 
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Sr no</th>
        <th scope="col">Jobs</th>
        <th scope="col">Client</th>
        <th scope="col">Assigned to </th>
        <th scope="col">Start Dt</th>
        <th scope="col">Due Dt</th>
        <th scope="col">Value Of Work</th>
        <th scope="col">Amount</th>
        <th scope="col">Balance</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php $k=1; for($i=0; $i < count($child); $i++) {  
      if($child[$i]->status == 1){
        $child[$i]->status = 'Open';
        $row_color = 'deep-orange lighten-3';
      } else if($child[$i]->status == 2){
        $child[$i]->status = 'Partial';
        $row_color = 'lime accent-2';
      } else if($child[$i]->status == 3){
        $child[$i]->status = 'Close';
        $row_color = 'green accent-1';
      } else {
        $child[$i]->status = 'No status';
        $row_color = '';
      }
      ?>
      <tr class="<?php echo $row_color?>">
        <td>
        <div>
          <input type="checkbox" id="<?php echo $child[$i]->id;?>" onclick='chintanselectsingle()' name="getid" value="<?php echo $child[$i]->id;?>">
          <label for="<?php echo $child[$i]->id;?>"></label>
        </div></td>
        <td scope="row"><?php echo $k;?></td>
        <td><?php echo $child[$i]->jobnumber;?></td>
        <td><?php echo $child[$i]->projectname;?></td>
        <td><?php echo $child[$i]->personalloted;?></td>
         <td ><?php echo $child[$i]->created_date;?></td>
        <td><?php echo $child[$i]->due_date;?></td>
        <td><?php echo $child[$i]->valueofwork;?></td>
        <td><?php echo $child[$i]->amount;?></td>
        <td><?php echo $child[$i]->balance;?></td>
        <td ><?php echo $child[$i]->status;?></td>

        <!-- <td><a class='tooltipped getid1' id="<?php echo $child[$i]->id;?>"  data-toggle="modal" data-target="#stdate"  data-position='top' data-delay='50' data-tooltip='Quick Edit'><i class='icon-table fa fa-bolt propericon blue-color'></i></a><a class='tooltipped' href='<?php echo site_url('site/edittransaction?id=').$child[$i]->id."&flag=1";?>' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-pencil propericon green-icon'></i></a><a class='tooltipped' href='<?php echo site_url('site/deletetransaction?id=').$child[$i]->id."&flag=".$this->input->get('id'); ?>' data-position='top' data-delay='50' data-tooltip='Delete'><i class='icon-table material-icons propericon red-icon '>delete</i></a></td> -->

        <td><a class='tooltipped getid1' id="<?php echo $child[$i]->id;?>"  data-toggle="modal" data-target="#stdate"  data-position='top' data-delay='50' data-tooltip='Quick Edit'><i class='icon-table fa fa-bolt propericon blue-color'></i></a></td>
      </tr>
    <?php $k++; }?>
    </tbody>
</table>
  </div>
</div>


<!-- Start Date Modal Starts -->
<div class="modal fade" id="stdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document" style="width: 449px;">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Edit Input Fields</h4>
        </div>
        <div class="modal-body">
          <form id="myForm" action="<?php echo site_url("site/submitSubJobDetails");?>" method="post">
          <div class="container col-md-12" style="padding-top: 8px;">
          <input type="hidden" name="id"  id="id" value="<?php echo set_value('id',$before->id);?>">
            <div class="row">
              <label for="created_date">Start Date:
              <input type="date"  name="created_date"  id="created_date" value="<?php echo set_value('created_date',$before->created_date);?>"></label>
              <label for="due_date">End Date:
              <input type="date"  name="due_date"  id="due_date" value="<?php echo set_value('due_date',$before->due_date);?>">
              </label></div>
              <!-- <div class="">
              <label>Description:</label>
              <textarea  id="description" name="description" class="materialize-textarea" placeholder="Enter text ...">
              <?php echo set_value( 'description',$before->description);?>
            </textarea>
            </div> -->
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </div>
        </form>
    </div>
  </div>
</div>
<!-- End Date Modal Starts -->
</main>
</body>
</html>
<script>
 
$( document ).ready(function() {
            $( ".getid1" ).click(function() {
              var id1 = $(this).attr("id");
              console.log(id1);
              $.get('getsingleperiodicjobs', {id:id1}, function(response) {
                  response = JSON.parse(response);
                  console.log(response.description);
                  $("#created_date").val(response.created_date);
                  $("#id").val(response.id);
                  $("#due_date").val(response.due_date);
                  $("#amount").val(response.amount);
                  $("#balance").val(response.balance);
                  $("#status").val(response.status);
              });
            });
            $('#myForm').ajaxForm({
              success: function(res, status, xhr, form) {
                  if(res == 1){
                    alert("Submitted");
                    $('#stdate').modal('hide');
                    location.reload();
                  }
              }
            });
});


$('.modal-dialog').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
var inputCheckArray = [];
var ids = [];
function chintanselectsingle(){
    inputCheckArray = $('input[type=checkbox]:checked');
}
function changestatus(getbuttonvalue){
  if(inputCheckArray.length!=0) {
             if(confirm("Are you sure you want to change status?")) {
                for(var i=0;i<inputCheckArray.length; i++){
                ids.push(inputCheckArray[i]['id']);
            }
            ajaxCall(ids,getbuttonvalue);
            }
            else{
                return false;
            }
        }
}

$("#create-invoice").click(function() {
        if(inputCheckArray.length!=0) {
                for(var i=0;i<inputCheckArray.length; i++){
                ids.push(inputCheckArray[i]['id']);
            }
            window.location.href = "redirectToInvoice?id="+ ids;
        } else if(selectallid.length !=0){
            window.location.href = "redirectToInvoice?id="+ selectallid;

        }
    });

    function ajaxCall(ids,getbuttonvalue) {
        console.log("ids "+ids);
        $.ajax({
                url: 'changeperiodicstatus',
                data: {'ids': ids, 'getbuttonvalue': getbuttonvalue}, 
                type: "post",
                success: function(data){
                console.log(data);
                    if(data == 1) {
                        location.reload();
                        alert("Status Changed Successfully");
                        
                    }else {
                        alert("Some error occured");
                    }
                }
            });
}
</script>
<style>
 .highlight-row{
        background-color:#10ffe9;
    }
    .icon-table{
        font-size: 19px;
        padding: 5px;
    }
    .red-icon{
        color: red;
    }
    .green-icon{
        color: #1b5e20;
    }
    .brown-icon{
        color:brown;
    }
    .darkblue{
        color: #0102f6;
       
    }
    .blue-color{
      color:#0d47a1;
    }
  
</style>
