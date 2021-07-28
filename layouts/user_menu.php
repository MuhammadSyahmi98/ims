
	<ul class="menu">
		<li>
   			 <a href="dashboard_user.php">
     		 <span>Dashboard</span>
   			 </a>
  		</li>
  		<li>
   			 
          <button class="dropdown-btn">Sales
            <img class="img" src="source/caretDown.png">
         </button>
         <ul class="nav-submenu">
            <li><a href="managesales.php">Manage sales</a> </li>
            <li><a href="addsales.php">Add sales</a> </li>
         </ul>
  		</li>
  		<li>
   			 
           <button class="dropdown-btn">Sales Report
           <img class="img" src="source/caretDown.png">
            </button>
         <ul class="nav-submenu">
            <li><a href="graph_month.php">Sales By Month</a> </li>
            <li><a href="graph_year.php">Sales By year</a> </li>
         </ul>
  		</li>
	</ul>

  <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>

