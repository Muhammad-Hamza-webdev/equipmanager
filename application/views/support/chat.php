<!doctype html>
<html lang="en" class="minimal-theme">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
	<!--plugins-->
	<link href="<?= base_url() ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

	<!-- loader-->
	<link href="<?= base_url() ?>assets/css/pace.min.css" rel="stylesheet" />



	<!--Theme Styles-->
	<link href="<?= base_url() ?>assets/css/dark-theme.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/light-theme.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/semi-dark.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/header-colors.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />

	<title>Ticket Chat </title>
	<style>
		.disabled-link {
  pointer-events: none; /* Disables mouse clicks */
  cursor: default;      /* Changes the cursor to indicate it's not clickable */
  color: gray;          /* Optional: Styles the link to look disabled */
  text-decoration: none; /* Optional: Removes the underline */
  background-color: #e9e9e9 !important;
}
	</style>
</head>

<body>


	<!--start wrapper-->
	<div class="wrapper">
		<?php $this->load->view('components/header'); ?>
		<?php $this->load->view('components/sidemenu'); ?>

		<!--start content-->
		<main class="page-content">
			<div class="chat-wrapper">
				<div class="chat-sidebar">
					<div class="chat-sidebar-header">
						<div class="d-flex align-items-center">
							<div class="chat-user-online">
								<img src="<?= base_url() ?>assets/images/avatars/avatar-1.png" width="45" height="45" class="rounded-circle" alt="" />
							</div>
							<div class="flex-grow-1 ms-2">
								<p class="mb-0"><?= $this->session->userdata('loginData')['userName'] ?></p>
							</div>
							<!-- <div class="dropdown">
									<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<div class="dropdown-menu dropdown-menu-end"> <a class="dropdown-item" href="javascript:;">Settings</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Help & Feedback</a>
										<a class="dropdown-item" href="javascript:;">Enable Split View Mode</a>
										<a class="dropdown-item" href="javascript:;">Keyboard Shortcuts</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Sign Out</a>
									</div>
								</div> -->
						</div>
						<div class="mb-3"></div>
						<div class="input-group input-group-sm"> <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
							<input type="text" class="form-control" placeholder="People, groups, & messages"> <span class="input-group-text bg-transparent"><i class='bx bx-dialpad'></i></span>
						</div>

					</div>
					<div class="chat-sidebar-content">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-Chats">
								<div class="p-3">
									<div class="meeting-button d-flex justify-content-between">
										<div class="dropdown"> <a href="<?= base_url('add-new-ticket') ?>" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret"><i class='bi bi-headset me-2'></i>Add New Ticket</a>

										</div>
									</div>
									<div class="dropdown mt-3"> <a href="#" class="text-uppercase text-secondary dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">Your Open Tickets </a>

									</div>
								</div>
								<div class="chat-list">
									<div class="list-group list-group-flush">
										<?php
										if ($allTickets) {
											foreach ($allTickets as $tickets) {
										?>
													<a href="<?= base_url('ticket-chat?ticketID=' . (int)$tickets['supportTicketID']) ?> " class="list-group-item <?= ($tickets['supportTicketStatus'] == 2) ? 'active' : '' ?> <?= ($tickets['supportTicketID'] == (int)$this->input->get('ticketID')) ? 'active' : '' ?>">
													<div class="d-flex">

														<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title"><?= h($tickets['supportCat']) ?></h6>
														<p class="mb-0 chat-msg"><?= h($tickets['supportSubject']) ?></p>
														</div>
														<div class="chat-time"><?php
																				$ts = $tickets['supportTicketTimeStamp'] ?? '';
																				$d = strtotime($ts);
																				// Show only date in human friendly format, fallback to original if parse fails
																				echo $d ? date('M j, Y', $d) : $ts;
																				?></div>
													</div>
												</a>
											<?php
											}
										} else {
											?>
											<div class="d-flex">

												<div class="flex-grow-1 ms-2">
													<h6 class="mb-0 chat-title">No Tickets Available</h6>
												</div>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="chat-header d-flex align-items-center">
					<div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
					</div>
					<div>
						<h4 class="mb-1 font-weight-bold"><?= h($cTicketData[0]['supportSubject']) ?></h4>
						<div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">
								<strong style="color:black">Status : &ensp; </strong> <span id="Ticketstatus">
									<?php
									if ($cTicketData[0]['supportTicketStatus'] == 1) {
										echo 'Waiting for Support';
									} else if ($cTicketData[0]['supportTicketStatus'] == 2) {
										echo 'Answered by Support';
									} else {
										echo 'Closed';
									}
									?>
								</span>
							</a>
							<?php
							if ($this->session->userdata('loginData')['userType'] == 1 && $cTicketData[0]['supportTicketStatus']!=3) {
							?>
								<a href="<?= base_url('marked-ticket-complete/'.$cTicketData[0]['supportTicketID']) ?>" class="btn btn-success">Mark as complete</a>
							<?php
							}
							?>
						</div>
					</div>

				</div>
				<div class="chat-content">
					<?php
					if ($cTicketChat) {
						foreach ($cTicketChat as $chat) {
							if ($chat['userID'] == $this->session->userdata('loginData')['userID']) {
					?>

								<div class="chat-content-rightside">
									<div class="d-flex ms-auto">
										<div class="flex-grow-1 me-2">
											<p class="mb-0 chat-time text-end">you | <?php
																						$ts = $chat['chatTimeStamp'] ?? '';
																						$t = strtotime($ts);
																						// format: "Jan 1, 2020 2:37 PM" — fallback to original if parse fails
																						echo $t ? date('M j, Y g:i A', $t) : $ts;
																						?></p>
											<p class="chat-right-msg"><?= h($chat['chatText']) ?></p>
										</div>
									</div>
								</div>
							<?php
							} else {
							?>
								<div class="chat-content-leftside">
									<div class="d-flex">
										<img src="<?= base_url() ?>assets/images/avatars/avatar-1.png" width="48" height="48" class="rounded-circle" alt="" />
										<div class="flex-grow-1 ms-2">
											<p class="mb-0 chat-time"><?php
																		if ($this->session->userdata('loginData')['userType'] == 1) {
																			echo $userData[0]['userName'] . ' | ';
																		} else {
																			echo 'Admin | ';
																		}
																		$ts = $chat['chatTimeStamp'] ?? '';
																		$t = strtotime($ts);
																		echo $t ? date('M j, Y g:i A', $t) : $ts;
																		?></p>
											<p class="chat-left-msg"><?= h($chat['chatText']) ?></p>
										</div>
									</div>
								</div>
					<?php
							}
						}
					}
					?>
				</div>
				<div class="chat-footer d-flex align-items-center">
					<div class="flex-grow-1 pe-2">
						<div class="input-group">
							<input type="text" 
							<?php 
								if($cTicketData[0]['supportTicketStatus']==3){
									echo 'disabled';
								}
							?>
							class="form-control" id="new-chat" name="new-chat" placeholder="Type a message">
						</div>
					</div>
<div class="chat-footer-menu"> <a  href="javascript:sendchat(<?= (int)$this->session->userdata('loginData')['userID']  ?>,<?= (int)$this->input->get('ticketID') ?>)"
					
					<?php 
								if($cTicketData[0]['supportTicketStatus']==3){
									echo 'class="disabled-link"';
								}
							?>
					 ><i class='bx bx-send'></i></a>
					</div>
				</div>
				<!--start chat overlay-->
				<div class="overlay chat-toggle-btn-mobile"></div>
				<!--end chat overlay-->
			</div>
		</main>
		<!--end page main-->


		<!--start overlay-->
		<div class="overlay nav-toggle-icon"></div>
		<!--end overlay-->

		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->



	</div>
	<!--end wrapper-->


	<!-- Bootstrap bundle JS -->
	<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?= base_url() ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?= base_url() ?>assets/js/pace.min.js"></script>
	<!--app-->
	<script src="<?= base_url() ?>assets/js/app.js"></script>
	<script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>assets/js/app-chat-box.js"></script>
	<script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
	<script>
		// Auto-scroll chat to bottom
		function scrollChatToBottom() {
			var $content = $('.chat-content');
			if ($content.length) {
				$content.scrollTop($content[0].scrollHeight);
			}
		}

		// Scroll on page load and Enter key listener
		$(function() {
			scrollChatToBottom();

			// Listen for Enter key in chat input
			$('#new-chat').keypress(function(e) {
				if (e.which == 13) { // 13 is Enter key code
					e.preventDefault(); // Prevent default Enter behavior
					sendchat(<?= (int)$this->session->userdata('loginData')['userID'] ?>, <?= (int)$this->input->get('ticketID') ?>);
				}
			});
		});

		function sendchat(userID, ticketID) {
			var chatmsg = $('#new-chat').val();
			if (chatmsg == '') {
				toastr.options = {
					"closeButton": true,
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				}
				toastr.error('Please add Message!');
				return false
			} else {
				//  Make an AJAX POST request
				$.ajax({
					url: '<?= base_url('add-new-chat-ajax') ?>', // URL to the controller method
					type: 'POST', // HTTP method
					data: {
						userID: userID,
						ticketID: ticketID,
						chat: chatmsg,
						'<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
					}, // Data to send

					success: function(response) {
						response = response.split('///');
						$curentchat = $('.chat-content').html();
						$curentchat = $curentchat + `<div class="chat-content-rightside">
									<div class="d-flex ms-auto">
										<div class="flex-grow-1 me-2">
											<p class="mb-0 chat-time text-end">you | ${response[0]}</p>
											<p class="chat-right-msg">${chatmsg}</p>
										</div>
									</div>
								</div>`;

						$('.chat-content').html($curentchat);
						$('#Ticketstatus').html(response[1]);
						scrollChatToBottom();
						toastr.options = {
							"closeButton": true,
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
						toastr.success('Message Sent!');
						$('#new-chat').val('');
					}
				});
			}


		}
	</script>
	<?php
	if ($this->session->flashdata('newTicket') != '') {
	?>
		<script type="text/javascript">
			toastr.options = {
				"closeButton": true,
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
			toastr.success('New Ticket Generated!');
		</script>
	<?php
	}
	?>

</body>

</html>