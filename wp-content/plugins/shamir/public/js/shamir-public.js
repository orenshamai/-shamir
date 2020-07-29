// List of global variables
var parentElementMainTable = null;

jQuery(document).ready(function($){

		list_manager.get_rec_text();

// Events Handler
		$('#addRow').on('click', list_manager.add_row);

		$("#list-table-body").on( "click", ".save-row", function() {
			uid = $(this).attr("user-id");
			//$('tr#u' + uid + ' input.uinfo').prop( "disabled", true );
			//$('tr#u' + uid + ' input.uinfo').addClass('view');
			list_manager.save_row();
		});

		$("#list-table-body").on( "click", ".edit-row", function() {
			uid = $(this).attr("user-id");
			$('tr#u' + uid + ' input.uinfo').prop( "disabled", false );
			$('tr#u' + uid + ' input.uinfo').removeClass('view');

		});


		$("#list-table-body").on( "click", ".delete-row", function() {
			uid = $(this).attr("user-id");
			list_manager.delete_row(uid);
		});


	//	$(".toggle-password").click(function() {
		$("#list-table-body").on( "focus blur", ".uinfo.password", function() {
		  $(this).closest('td').find('span').toggleClass("fa-eye fa-eye-slash");
		  var input = $(this);
		  if (input.attr("type") == "password") {
		    input.attr("type", "text");
		  } else {
		    input.attr("type", "password");
		  }
		});



});


var list_manager = {

		users_object: {},

		fill_users_object: function(json_users) {
			this.users_object = json_users;
			this.update_users();
		},

    add_row: function(x) {
			parentElementMainTable = document.getElementById('list-table-body');

			// Create the row element
			if(!!x || x === '') {
					var timestamp = new Date().getUTCMilliseconds();

			} else {
				var timestamp = x;
				console.log(x);
			}


	    var tr = document.createElement("tr");

			tr.setAttribute("id", 'u'+timestamp);

			tr.innerHTML = '\
			<td><input class="uinfo uid" type="hidden" name="uid" value="'+ timestamp +'"><span class="uid-txt">User ID: '+ timestamp +'</span></td> \
			<td><input class="uinfo site_url" name="site_url" type="text" placeholder="Site URL"></td> \
			<td><input class="uinfo username" name="username" type="text" placeholder="Username"></td> \
			<td><input class="uinfo password" name="password" type="password" placeholder="Password"><span class="fa fa-fw fa-eye field-icon toggle-password"></span></td> \
			<td><input class="uinfo desc" name="desc" type="text" placeholder="Description"></td> \
			<td><button type="button" user-id="'+timestamp+'" class="save-row">Save</button><button type="button" user-id="'+timestamp+'" class="edit-row">Edit</button><button user-id="'+timestamp+'" type="button" class="delete-row">Delete</button></td> ';
	    // Append the final row to the table
	    parentElementMainTable.appendChild(tr);
		},

		save_row: function() {

				var json_users =[];
				$('#list-table-body tr').each(function() {

					var uid = $('td input.uid', this).val();
					var site_url = $('.site_url',this).val();
					var uname = $('input.username',this).val();
					var pass = sha512($('.password',this).val());
					var desc = $('.desc',this).val();
						json_users.push({
								uid: uid,
								site_url: site_url,
								uname: uname,
								pass: pass,
								desc: desc
						});

				});

				list_manager.fill_users_object(json_users);
		},


		/*edit_row: function(uid) {
			console.log(uid);
			$('tr#u' + uid + ' input.uinfo').prop( "disabled", false );
			$('tr#u' + uid + ' input.uinfo').removeClass('view');
		},*/

		delete_row: function(uid) {
		 console.log(uid);
		 $('tr#u'+uid).remove();

		 function removeItemsById(arr, uid) {

    	var i = arr.length;
			console.log(list_manager.users_object);
    	if (i) {   // (not 0)
        while (--i) {
            var cur = arr[i];
            if (cur.uid == id) {
                arr.splice(i, 1);
			            }
			        }
			    }
			}

			removeItemsById(list_manager.users_object, uid);


			console.log(JSON.stringify(list_manager.users_object));

	 },


	 update_users: function() {

		 var str = $("article").attr("id");
		 var pid = str.substr(str.indexOf("-") + 1)



		 $.post(ajaxurl, {
				 action:     'summ_update',
				 post_id:    pid,
				 users_json: JSON.stringify(this.users_object),
		 }, function (response) {

			 if (1 === parseInt(response)) {
					 $(".loading-overlay").fadeOut();
					 //swal('GOOD','all saved','success')
					 swal('GOOD','Users saved','success')


			 } else {
					 $(".loading-overlay").fadeOut();
					 swal('GOOD','not saved','success')
					 // swal('GOOD','all already  saved','success')

			 } // end if/else

		 });


	 },

	 get_rec_text: function(testID,ts) {

		 	var str = $("article").attr("id");
		 	var pid = str.substr(str.indexOf("-") + 1)

			 $.post(ajaxurl, {
					 action:     'get_rec',
					 post_id:    pid,
				 }, function (response) {
				 response = JSON.parse(response);
				 console.log(response);
				 $.each(response, function(a,b){
					 list_manager.add_row(b.uid);
					 $tr = $("#list-table-body tr").last();

					 $(".uid",$tr).val(b.uid);
					 $(".uid-txt",$tr).text('User ID: '+ b.uid);
					 $(".site_url",$tr).val(b.site_url);
					 $(".username",$tr).val(b.uname);
					 $(".password",$tr).val(b.pass);
					 $(".desc",$tr).val(b.desc);

					 $('input.uinfo').prop( "disabled", true );
					 $('input.uinfo').addClass('view');

				 })
				 //list_manager.fill_users_object(response);

			 });

	 }


}
