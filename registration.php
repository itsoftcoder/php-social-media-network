<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration page | social network</title>
    <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="styles/css/fonts.css" type="text/css" rel="stylesheet">

    <script src="styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="styles/js/popper.js" type="text/javascript"></script>
    <script src="styles/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">

    <div class="row text-center text-white" style="background: rgba(14,15,103,0.70)">
        <div class="col-sm-12">
            <h3 class="p-4">Social Network</h3>
        </div>
    </div>

    <div class="row mt-2 p-2">
        <div class="offset-sm-2 col-sm-8 offset-sm-2">
            <div class="card">

                <div class="card-header">
                    Create A new Account Below
                </div>

                <div class="card-body">
                    <form method="post" action="insert_user.php">

                        <div class="form-group row">
                            <label class="col-sm-3">First Name : </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="fname" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Last Name : </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="lname" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Email Address : </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Password : </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="text" name="pass" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Confirm Password : </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="text" name="cpass" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-md-6">Country Name : </label>
                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-newspaper-o"></i></span>
                                        </div>
                                        <select name="country" class="form-control">
                                            <option>Bangladesh</option>
                                            <option>Pakistan</option>
                                            <option>India</option>
                                            <option>America</option>
                                            <option>England</option>
                                            <option>Austrelia</option>
                                            <option>Singapure</option>
                                            <option>Srilanka</option>
                                            <option>NewZeland</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-md-4">Select Gender : </label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-ge"></i></span>
                                        </div>
                                        <select name="gender" class="form-control">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Date Of Birth : </label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-database"></i></span>
                                </div>
                                <input type="date" class="form-control" name="dob">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <input type="submit" name="signup" class="btn btn-sm btn-success w-50" value="Registration">
                            </div>
                        </div>




                    </form>
                </div>

                <div class="card-footer">
                    <div class="clearfix">
                        <p class="float-left">
                            <strong>Today : </strong>
                            <?php
                            echo date('d-m-Y h:i:s' );
                            ?>
                        </p>
                        <a href="login.php" class="float-right">You have already created on account,Please login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-3 mt-2" style="background: #1c7430;">
        <div class="col-md-12 text-white text-center">
            <p>@copy right alamin hossain 2019</p>
        </div>
    </div>
</div>
</body>
</html>
