<?php require_once 'inc/header.php'; ?>

<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">Dashboard</li>
        </ol> 
    </div>
</section>

<section id="main">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="index.php" class="list-group-item active main-color-bg">Dashboard</a>
                <a href="#" class=" warning list-group-item "> <span class="glyphicon glyphicon-list-alt"></span> Pages   <span class="badge">33</span>  </a>
                <a href="#" class=" primary list-group-item "> <span class="glyphicon glyphicon-pencil"></span> <span class="badge">23</span> Posts</a>
                <a href="#" class="list-group-item "><span class="glyphicon glyphicon-user"></span><span class="badge">25</span>   Users</a>
            </div>

            <div class="well">
                <h4>Disk Space Used</h4>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                            style="width: 60%;">
                            <span>40% Complete</span>
                    </div>
                </div>
                <h3>Bandwidth Used</h3>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                            style="width: 40%;">
                            <span>40% Complete</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9 ">
            <!-- Website overview -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg">
                    <h3 class="panel-title"> Panel title</h3>
                </div>
                <div class="panel-body">
                   <div class="col-md-3">
                       <div class="well dash-box">
                           <h2><span class="glyphicon glyphicon-user"></span> 203 </h2>
                            <h4>Users</h4>
                       </div>
                   </div>
                   <div class="col-md-3">
                        <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-list-alt"></span> 12 </h2>
                                <h4>Pages</h4>
                            </div>
                   </div>
                   <div class="col-md-3">
                        <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-pencil"></span> 1203 </h2>
                                <h4>Posts</h4>
                            </div>
                   </div>
                   <div class="col-md-3">
                        <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-stats"></span> 1203 </h2>
                                <h4>Visitors</h4>
                            </div>
                   </div>
                </div>
            </div>

            <!-- Lates Users -->
            <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                            <h3 class="panel-title"> Latest Users </h3>
                        </div>
                <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                <!-- <caption>Responsive Table Layout</caption> -->
                                <thead>
                                <tr>
                                <th>Product</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td>Product1</td>
                                <td>23/11/2013</td>
                                <td>Pending</td>
                                </tr>
                                <tr>
                                <td>Product2</td>
                                <td>10/11/2013</td>
                                <td>Delivered</td>
                                </tr>
                                <tr>
                                <td>Product3</td>
                                <td>20/10/2013</td>
                                <td>In Call to confirm</td>
                                </tr>
                                <tr>
                                <td>Product4</td>
                                <td>20/10/2013</td>
                                <td>Declined</td>
                                </tr>
                                </tbody>
                                </table>
                </div>
            </div>






        </div>  <!-- // End of col-md-9 -->
    </div> <!--//  End of row -->
</div> <!--  // End of the container-->
    </div>
</section>
      
<?php require_once 'inc/footer.php'; ?>








<!-- Modals  section  -->
<!-- Add Page -->
<!-- Modal -->
<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <form>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Add Page</h4>
        </div>
    
        <div class="modal-body">
           <div class="form-group">
               <label for="">Page Title</label>
               <input type="text" class="form-control" placeholder="Page title">
           </div>
           <div class="form-group">
                <label for="">Page Body</label>
                <textarea name="editor1" class="form-control"placeholder="Page Body" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="checkbox">
                    <label>
                    <input type="checkbox"> Published
                    </label>
                    
            </div>
            <div class="form-group">
                    <label for="">Meta Tags</label>
                    <input type="text" class="form-control" placeholder="Add some tag...">
            </div>
            <div class="form-group">
                    <label for="">Meta description</label>
                    <input type="text" class="form-control" placeholder="Meta description">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Submit changes</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal -->
</div>


</body>
</html>