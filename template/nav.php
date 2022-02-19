<?php defined('BASEPATH') OR exit('no direct script access allowed');
?>
<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
	<div class="navbar-logo">
		<h1 class="text-light fw-bold">
			<?php echo $webconfig['title']; ?>
		</h1>
	</div>
	<nav class="sidebar-nav">
		<ul>
			<li class="nav-item <?php if(preg_match("/\/[a-zA-Z]+\/$/",$_SERVER['REQUEST_URI']) or $_SERVER['REQUEST_URI'] == '/'){echo "active";}?>">
				<a href="./">
					<span class="icon"><i class="lni lni-dashboard"></i></span>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'checker'){echo "active";}?>">
				<a href="./?module=checker">
					<span class="icon"><i class="lni lni-blogger"></i></span>
					<span class="text">Checker</span>
				</a>
			</li>	

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'allfeedurl'){echo "active";}?>">
				<a href="./?module=allfeedurl">
					<span class="icon"><i class="lni lni-blogger"></i></span>
					<span class="text">All Feed URL</span>
				</a>
			</li>

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'readfeed'){echo "active";}?>">
				<a href="./?module=readfeed">
					<span class="icon"><i class="lni lni-blogger"></i></span>
					<span class="text">Read Feed</span>
				</a>
			</li>						
			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'validator'){echo "active";}?>">
				<a href="./?module=validator">
					<span class="icon"><i class="lni lni-blogger"></i></span>
					<span class="text">Validator</span>
				</a>
			</li>	

		</ul>
	</nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->