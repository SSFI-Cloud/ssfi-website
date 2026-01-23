<?php if(1){ ?>
<?php include('header.php') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .dropdown-wrapper select {
    border: 1px solid green;
  }
  .card-custom {
    border: 1px solid green;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .btn1 {
    background-color: orange !important;
  }
</style>

<div data-role="main" class="ui-content">
    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; padding:5%">
    <div class="row" id="event_list">
        
    </div>
      </div>
</div>


<script>
  $(document).ready(function () {
    getDropDown('tbl_states', 'state_id', 'state_name');
    GetEventList();
    $('#state_id').on('change', function () {
      const state_id = $(this).val();
    GetEventList();
      $('#eventDetails').hide(); // hide card on state change
    });
  });

  function getDropDown(tablename, id, value, conditions = {}, selected_id = null) {
    $.ajax({
      url: `../admin/api/helper/drop-down.php?is_front=1&table=${tablename}&columns=id,${value}&orderby=${value}&conditions=${encodeURIComponent(JSON.stringify(conditions))}`,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.success) {
          let dropdown = $(`#${id}`);
          dropdown.empty().append('<option value="">Select</option>');
          response.data.forEach(item => {
            let isSelected = (selected_id && item.id == selected_id) ? 'selected' : '';
            dropdown.append(`<option value="${item.id}" ${isSelected}>${item[value]}</option>`);
          });
        } else {
          console.error("Dropdown Error:", response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Dropdown Error:", error);
      }
    });
  }
//   $('#district_id').on('change', function () {
//   const district_id = $(this).val();

//   if (state_id) {
//     $.ajax({
//       url: `api/get-event-details.php?district_id=${district_id}`,
//       type: 'GET',
//       dataType: 'json',
//       success: function (res) {
//         if (res.success) {
//           $('#eventName').text(res.data.event_name);
//           $('#eventDate').text(res.data.event_date);
//           $('#eventVenue').text(res.data.event_venue);
//           $('#eventDetails').slideDown(); // shows with animation
//           GetEventList();
//         } else {
//           $('#eventDetails').slideUp(); // hide if no data
//         }
//       },
//       error: function () {
//         $('#eventDetails').slideUp();
//       }
//     });
//   } else {
//     $('#eventDetails').slideUp(); // hide when district is cleared
//   }
// });




function GetEventList(){
    var search=$('#search').val();
    $.ajax({
      url: `api/api-get-event-list-national.php?search=`+search,
      type: 'GET',
      success: function (res) {
        console.log(res);
        $('#event_list').html(res);
      },
      error: function (xhr, status, error) {
        console.error('Event AJAX Error:', error);
      }
    });
}




//   function getEventDetails(district_id) {
//     if (!district_id) return $('#eventDetails').hide();

//     $.ajax({
//       url: `api/get-event-details.php?district_id=${district_id}`,
//       type: 'GET',
//       dataType: 'json',
//       success: function (res) {
//         if (res.success) {
//           $('#eventName').text(res.data.event_name);
//           $('#eventDate').text(res.data.event_date);
//           $('#eventVenue').text(res.data.event_venue);
//           $('#eventDetails').show();
//         } else {
//           $('#eventDetails').hide();
//           console.log(res.message);
//         }
//       },
//       error: function (xhr, status, error) {
//         console.error('Event AJAX Error:', error);
//         $('#eventDetails').hide();
//       }
//     });
//   }

  $('#registerBtn').on('click', function () {
    alert("Redirect to registration or open form...");
    // location.href = 'register-form.php'; // Uncomment if needed
  });
  
  
  
</script>

<?php } else{?>
<h3 style="color:red;text-align:center;margin-top:5%">Coming Soon</h3>

<?php } ?>
<?php include('../footer.php') ?>
