<h3>Delete Meetings</h3>
<div style="display: inline-block;">
<form action="deleteMeetings.php" method="POST">
   <p>From:</p>
   <input type="date" name="delete-from"> 
   <input type="time" name="delete-from-time">
   <p>To:</p>
   <input type="date" name="delete-to">
   <input type="time" name="delete-to-time"> <br>   
  
   <input type="radio" name="delete-specification" value=0>Empty only</input> <br>
   <input type="radio" name="delete-specification" value=1>All</input> <br>

   <input type="submit" value="Delete">
</form>
</div>