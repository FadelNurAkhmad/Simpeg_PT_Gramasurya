<div class="login bg-warning animated fadeInDown">
	<!-- begin brand -->
	<div class="login-header">
		<div class="brand">
			GRAMASURYA
			<small>Sistem Informasi Manajemen Kepegawaian</small>
		</div>
		<div class="icon">
			<ul class="chats">
				<li class="right">
					<span class="image"><img alt="simpeg" src="assets/img/logo-grama.png"></span>
				</li>
			</ul>
		</div>
	</div>
	<!-- end brand -->
	<div class="login-content">
		<form action="index.php?page=login&op=in" method="POST" class="margin-bottom-0">
			<div class="form-group m-b-20 has-feedback">
				<input type="text" name="id_user" class="form-control input-lg no-border" placeholder="Username" required /><span class="fa fa-user form-control-feedback"></span>
			</div>
			<div class="form-group m-b-20 has-feedback">
				<input type="password" name="password" maxlength="255" class="form-control input-lg no-border" placeholder="Password" required /><span class="fa fa-lock form-control-feedback"></span>
			</div>
			<div class="login-buttons">
				<button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-key"></i> &nbsp;Login</button>
			</div>
			<div class="m-t-20 text-white">
				Lupa Password ? coba

				<a href="https://api.whatsapp.com/send?phone=<?= $data['helpdesk'] ?>&text=Selamat Datang!" target="_blank">hubungi</a>
				admin.
			</div>
		</form>
	</div>
</div>
<?php
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
	echo "<br /><div class='pesan alert alert-warning col-sm-8 col-sm-offset-2'>
			 <span class='close' data-dismiss='alert'>x</span> <i class='fa fa-info fa-2x pull-left'></i> " . $_SESSION['pesan'] . "
		</div>";
}
$_SESSION['pesan'] = "";
?>
<script>
	// 500 = 0,5 s
	$(document).ready(function() {
		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>