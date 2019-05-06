@extends('master')
@section('content')
	<div class="grow">
		<div class="container">
			<h2>ទំនាក់ទំនង</h2>
		</div>
	</div>
	<!-- grow -->
	<!--content-->
	<div class="contact">

		<div class="container">
			<div class="contact-form">

				<div class="col-md-8 contact-grid">
					<form class="" role="form" method="POST" id="form-add">
						{{ csrf_field() }}

						<input class="input-name" type="text" name="name" placeholder="Name">
							<span class="text-danger">
                              <strong id="name-error"></strong>
                        </span>

						<input class="input-email" type="text" name="email" placeholder="Email">
						<span class="text-danger">
                               <strong id="email-error"></strong>
                        </span>
						<input class="input-subject" type="text" name="subject" placeholder="Subject">
						<span class="text-danger">
                               <strong id="subject-error"></strong>
                        </span>
						<textarea class="input-message" cols="77" rows="6" name="message" placeholder="Message"></textarea>
						<span class="text-danger">
                              <strong id="message-error"></strong>
                        </span>
						<div class="send">
							<input type="submit" value="Send">
						</div>
					</form>
				</div>
				<div class="col-md-4 contact-in">

					<div class="address-more">
						<h4>Address</h4>
						<p>LV-Furniture</p>
						<p>Street 173
							Phnom Penh 23</p>
						<p>Phone: 023 633 9999</p>
					</div>


				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="row" style="text-align: center">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.9441193709595!2d104.91015751502698!3d11.555863791795547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109511776971a3b%3A0x76aa8c5a69fb1e7c!2sLV.+Furniture+Co.%2C+Ltd!5e0!3m2!1sen!2skh!4v1523378791892" width="1110" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>

	</div>
	<!--//content-->

	<script type="text/javascript">
        $('#form-add').submit(function (e) {
            e.preventDefault();

            has_errors('.input-name', '#name-error');
            has_errors('.input-email', '#email-error');
            has_errors('.input-subject', '#subject-error');
            has_errors('.input-message', '#message-error');

			/* Create new varaible that store all values from form From User\*/
            var form = new FormData($("#form-add")[0]);
            $.ajax({
				/* location to go*/
                url: "{{route('contacts.create')}}",
                method: "POST",
                dataType: 'json',
				/* Send all values from Users to controller to check*/
                data: form,
                processData: false,
                contentType: false,
                success: function (data) {
					/* When controller is complete it send back value to data*/
                    console.log(data);

					/* Display all the errors message*/
                    if (data.errors) {
                        if (data.errors.name) {
                            errors('#name-error', data.errors.name[0], '.input-name');
                        }

                        if (data.errors.email) {
                            errors('#email-error', data.errors.email[0], '.input-email');
                        }

                        if (data.errors.subject) {
                            errors('#subject-error', data.errors.subject[0], '.input-subject');
                        }

                        if (data.errors.message) {
                            errors('#message-error', data.errors.message[0], '.input-message');
                        }
                    }

					/* Clear all the value when send is success*/
                    if (data.verify == 'true') {
                        Command: toastr["success"]("Message have been sent!");
                        $("#form-add")[0].reset();

                    }
                },
                error: function (er) {
                }
            });
        });


        function has_errors(input_name,label_error) {
            $(input_name).parent().removeClass('has-error');
            $(label_error).html( "" );
        }

        function errors(label_error,error_text,input_name) {
            $(input_name).parent().addClass('has-error');
            $(label_error).html(error_text);
        }
	</script>
@endsection