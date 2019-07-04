<!--<head>-->
<!--<style>
input[type=text], input[type=password] {
    background-color: #4CAF50;
    border: none;
    color: none;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    width:12s%;
    text-align:center;
    resize:none;
    
    


}
input[type=submit]{
  color : black;
  margin: 4px 2px;
  border : 4px 2px;
 font-weight : bold;
}
</style>-->

<br/>
<br/>

<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h1>Login</h1>
          <!--<body style= "text-align:center; color:black;border: 100px solid black;
              background-color: orange;
              /* padding: 50px 30px 50px 80px;text-transform: capitalize;font-family: times new roman;"> -->
        </div>
        <div class="card-body">
          <form class="form" action="login/run" method="post">
            <label> User ID </label><input class="form-control" type="text" name="userId"/><br/>
            <label>Password </label><input class="form-control" type="password" name="password"/><br/>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-3"></div>
  </div>
</div>
