<!DOCTYPE html>
<html lang="en">
<head>
  <title>Send Msg</title>
  <meta charset="UCS-2">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Credosync Send SMS</h2>
  <form class="form-horizontal" name="smsForm" method="post" action="send-sms.php" enctype="multipart/form-data" >
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Upload File:</label>
      <div class="col-sm-10">
        
        <input type="file" name="csvfile" id="csvfile" required > CSV File To Upload<br />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="msg">Msg:</label>
      <div class="col-sm-10">          
         <textarea class="form-control" rows="5" id="msg" name="msg" required></textarea>
      </div>
    </div>
     
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
