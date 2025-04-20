

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function show() {
  document.getElementById("waa").classList.toggle("show");
}



function showsignform(name){
  if(name=='signup'){
    $(".sign-form").eq(0).css("display","flex");
    $(".sign-form").eq(0).css("animation",".3s fadein")
    $("body").addClass('darken');
  }
  else{
    $(".sign-form").eq(1).css("display","flex");
    $(".sign-form").eq(1).css("animation",".3s fadein")
    $("body").addClass('darken');
  }
}
// Close the dropdown menu if the user clicks outside of it
document.querySelectorAll('.icon').forEach(function (icon) {
  icon.addEventListener('click', function (event) {
    event.stopPropagation(); // Prevent button's click event from firing when icon is clicked
    var button = icon.closest('#nav-menu-button');
    if (button) {
      button.click(); // Trigger button's click event
    }
  });
});
window.onclick = function (event) {
  if (!event.target.matches('#nav-menu-button')) {
    var menu = document.getElementById("waa");
    if (menu.classList.contains("show")) {
      menu.classList.remove("show");
    }
  }
}
var currentDate = moment().format("YYYY-MM-DD");
// if ($('.date-reserve-from, .date-reserve-until').length) {
  $("#checkin,#checkout").daterangepicker({
    locale: { format: 'YYYY-MM-DD' },
    "alwaysShowCalendars": true,
    "minDate": currentDate,
    autoApply: true,
    autoUpdateInput: false,

  },
    function (start, end, label) {
      var selectedStartDate = start.format('YYYY-MM-DD'); // selected start
      var selectedEndDate = end.format('YYYY-MM-DD'); // selected end

      $checkinInput = $('#checkin');
      $checkoutInput = $('#checkout');

      // Updating Fields with selected dates
      $checkinInput.val(selectedStartDate);
      $checkoutInput.val(selectedEndDate);

      // Setting the Selection of dates on calender on CHECKOUT FIELD (To get this it must be binded by Ids not Calss)
      var checkOutPicker = $checkoutInput.data('daterangepicker');
      checkOutPicker.setStartDate(selectedStartDate);
      checkOutPicker.setEndDate(selectedEndDate);

      // Setting the Selection of dates on calender on CHECKIN FIELD (To get this it must be binded by Ids not Calss)
      var checkInPicker = $checkinInput.data('daterangepicker');
      checkInPicker.setStartDate(selectedStartDate);
      checkInPicker.setEndDate(selectedEndDate);
    });
// }
