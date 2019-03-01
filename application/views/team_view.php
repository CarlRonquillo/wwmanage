<?php include('header.php'); ?>

<style type="text/css">
	#editCurProj
	{
		display:none;
	}
	#editCurProj:target
	{
		display:block;
	}
	#CurProj:target
	{
		display:block;
	}

	.autocomplete {
  position: relative;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

<main>
    <div class="container-fluid">
    	<div class="card">
    		<h4 class="card-header blue-gradient white-text text-center py-3"><?php echo $team->TeamName;?></h4>
  			<div class="card-body">
  				<?php 
					if($error = $this->session->flashdata('response')):
					{						
				?>
					<div class="alert alert-success">
						<span class ="glyphicon glyphicon-info-sign"></span>
						<?php echo $error; ?>
					</div>
				<?php 
					}
					endif
				?>

				<div id="CurProj">
					Current Project:<h4><?php echo (isset($team->FKProjectID) ? anchor("project/view/{$team->FKProjectID}",$team->ProjectName,["class"=>"text-default"]) : 'None')?><a href="#editCurProj" class="amber-text" style="font-size:15px;padding-left:1em;"><i class="fas fa-pencil-alt"></i></a></h4><br>
				</div>


				<div id="editCurProj">
				<?php echo form_open("Teams/saveCurrentProject/{$team->TeamID}",['method' => 'post','id' => 'frm_project']); ?>
					<div class="input-group">
						<div class="form-group col-lg-3">
							<label>Projects</label>
							<?php $project_array = array();
								foreach($projectNames as $projectName)
		              {
		                $project_array[$projectName->ProjectID]=$projectName->ProjectName;
		              }
								echo form_dropdown(['id' => 'FKProjectID','name' => 'FKProjectID', 'class' => 'browser-default custom-selectcol-lg-6','autocomplete' => 'off','onChange' => 'changecat(this.value);'],$project_array,$team->FKProjectID); ?>
							<span><?php echo form_error('FKProjectID') ?></span>
						</div>
						<div class="form-group">
							<?php echo form_submit(['value' => 'SAVE','class' => 'btn btn-sm btn-primary']); ?>
							<a href="#CurProj" class="btn btn-sm btn-danger" role="button">CANCEL</a>
						</div>
					</div>
				</div>
					
				<?php echo form_close(); ?>

				<div class="card">
					<div class="card-body">
						<h4 class="text-warning card-title">Team Members</h4>
            <?php echo form_open("Teams/addMember/{$team->TeamID}",['method' => 'post','id' => 'frm_project','class' => "form-inline mr-auto"]); ?>
            <div class="input-group">
  						<div class="form-group autocomplete">
  							<?php echo form_input(['type' => 'text','name' => 'search','id' => 'search', 'class' => 'form-control mr-sm-2','autocomplete' => 'off', 'placeholder' => 'search members here','value' => '','autofocus' => true]); ?>
              </div>
              <div class="form-group">
                <?php echo form_submit(['value' => 'Add','class' => 'btn btn-sm btn-primary']); ?>
              </div>
            </div>
            <?php echo form_close(); ?>
						<hr>
			  			<div class="table-responsive text-wrap table-hover table-striped">
			  			<div class="card-group">
						  <table class="table">
						    <thead>
						      <tr>
						        <th scope="col" class="font-weight-bold dark-grey-text">#</th>
						        <th scope="col" class="font-weight-bold dark-grey-text">Full Name</th>
						        <th scope="col" class="font-weight-bold dark-grey-text">Email Address</th>
                    <th></th>
						      </tr>
						    </thead>
						    <tbody>
						    <?php $i = 0;
						    	if(isset($members)):  ?>
						    	<?php foreach($members as $member) {?>
							      <tr class="text-danger">
							        <td scope="row"><?php echo $i += 1; ?></td>
							        <td><?php echo anchor("Users/view/{$member->PersonID}",$member->GivenName.' '.$member->FamilyName,["class"=>"text-info"]) ?></td>
							        <td><?php echo $member->EmailAddress;?></td>
                      <td><?php echo anchor("Teams/removeMember/{$member->PersonID}/{$team->TeamID}","<i class='fa fa-remove text-danger'></i>",["class"=>"","onclick" => "return confirm('Are you sure you want remove this member?')"]);?></td>
							      </tr>
							    <?php } else: ?>
							    <td>No record(s) Found!</td>
							<?php endif; ?>
						    </tbody>
						  </table>
						</div>
						</div>
					</div>
				</div>
  			</div>
  		</div>
  	</div>
</main>

<?php 
        $user_array = array();
        if(isset($Users))
        {
            foreach($Users as $User)
            {
                $user_array[] = $User->GivenName.' '.$User->FamilyName.' - '.$User->PersonID;
            }
        }
    ?>

<?php include('footer.php'); ?>

    <script>
        function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = <?php if(isset($user_array)) {echo json_encode($user_array);} ?>;

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("search"), countries);
</script>