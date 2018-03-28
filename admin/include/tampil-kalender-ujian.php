<script>
$(document).ready(function(e) {
    $("#eventCalendarHumanDate").eventCalendar({
		eventsjson: 'json/kalender.php',
		jsonDateFormat: 'human',  // 'YYYY-MM-DD HH:MM:SS'
	});
});
</script>
<div id="eventCalendarHumanDate"></div>