// to get current year
function getYear() {
	var currentDate = new Date();
	var currentYear = currentDate.getFullYear();
	document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

// // map form show
// if (document.querySelector("#showMap")) {
//     document.querySelector("#showMap").addEventListener("click", function (e) {
//         e.preventDefault();
//         $(".map_form_container").addClass("map_show");
//         document.querySelector(".contact_heading").innerText = "Location";
//     });
// }
// if (document.querySelector("#showForm")) {
//     document.querySelector("#showForm").addEventListener("click", function (e) {
//         e.preventDefault();
//         $(".map_form_container").removeClass("map_show");
//         document.querySelector(".contact_heading").innerText = "Contact Us";
//     });
// }

// /** google_map js **/
// function myMap() {
//     var mapProp = {
//         center: new google.maps.LatLng(40.712775, -74.005973),
//         zoom: 18,
//     };
//     var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
// }


// Form handling 

$(document).ready(function () {
	$("#processCFData").on("click", function (e) {
		e.preventDefault();

		const identifier = $("#identifier").val();
		const fname = $("#fname").val();
		const lname = $("#lname").val();
		const email = $("#email").val();
		const phone = $("#phone").val();
		const msg = $("#msg").val();

		let arr = {
			identifier: identifier,
			fname: fname,
			lname: lname,
			email: email,
			phone: phone,
			msg: msg
		};

		$.ajax({

			url: `api/blue.php?=ts${new Date().getTime()}`,
			type: "POST",
			data: JSON.stringify(arr),
			contentType: "application/json; charset=utf-8",
			beforeSend: function () {
				// $('.ajax-loader').css("visibility", "visible");
			},
			complete: function () {
				// $('.ajax-loader').css("visibility", "hidden");
			},
			success: function (response) {
				const resp = JSON.parse(response);

				if (resp.status == "error") {
					switch (resp.for) {
						case "fname":
							$("#fname").addClass("border-danger");
							$("#status_fname")
								.addClass("text-danger")
								.fadeIn(500)
								.html(resp.msg);

							$("#fname").keyup(function () {
								$("#fname").removeClass("border-danger");
								$("#status_fname").removeClass("text-danger");
								$("#status_fname").empty();
							});
							break;

						case "contact_form":
							$("#status_cf")
								.addClass("text-danger")
								.fadeIn(500)
								.html(resp.msg);

							setTimeout(function () {
								$("#status_cf").fadeOut("slow");
								$("#status_cf").empty();
							}, 3000);
							break;

					} // Switch Case Ending
				} else if (resp.status == "success") {
					switch (resp.for) {
						case "contact_form":

							$("#status_cf")
								.addClass("text-success")
								.fadeIn(500)
								.html(resp.msg);

							$("#find-a-mechanic-form").trigger("reset");

							setTimeout(function () {
								$("#status_cf").fadeOut("slow");
								$("#status_cf").removeClass("text-success");
								$("#status_cf").empty();
							}, 3000);
							break;
					} // Switch Case Ending
				} else {
					$("#status_cf")
						.addClass("text-danger")
						.fadeIn(500)
						.html(resp.msg);

					setTimeout(function () {
						$("#status_cf").fadeOut("slow");
						$("#status_cf").removeClass("text-danger");
						$("#status_cf").empty();

					}, 3000);
				}
			},

			error: function () {
				$("#status_cf")
					.addClass("text-danger")
					.fadeIn(500)
					.html("No Internet");

				setTimeout(function () {
					$("#status_cf").fadeOut("slow");
					$("#status_cf").empty();
				}, 3000);
			},
		}); // Ajax End
	}); // Function End
}); // Document Function End

