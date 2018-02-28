<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Crud Angular</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body>

<div class="col-md-12"><br><br>
	<div class="alert alert-warning">
		<?php echo $this->session->flashdata('msg'); ?>
	</div>
	<h3 align="center"></h3>
	<div ng-app="myApp" ng-controller="controller" ng-init="show_data()">
		<div class="col-md-6">
		   	<label>Name</label>
            <input type="text" name="nama" ng-model="nama" class="form-control">
            <br/>
            <label>No Telpon</label>
            <input type="text" name="notelp" ng-model="notlp" class="form-control">
            <br/>
            <label>alamat</label>
            <input type="text" name="alamat" ng-model="alamat" class="form-control">
            <br/>
            <input type="hidden" ng-model="id">
            <input type="submit" name="tambah" class="btn btn-primary" ng-click="insert()" value="{{btnName}}">
		</div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>no telp</th>
                    <th>alamat</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr ng-repeat="x in biodatas" >
										<td>{{x.id}}</td>
                    <td>{{x.nama}}</td>
                    <td>{{x.notelp}}</td>
                    <td>{{x.alamat}}</td>
                    <td>
                        <button class="btn btn-success btn-xs" ng-click="edit_data(x.id, x.nama, x.notelp, x.alamat)">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" ng-click="delete_data(x.id)">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>

                    </td>

                </tr>
            </table>
        </div>
</div>
<script type="text/javascript">
		var app = angular.module("myApp", [] );

		app.controller("controller", function($scope, $http) {
			$scope.btnName = "Insert";
			$scope.insert = function(){
				if($scope.nama == null ){
					alert("harus diisi 1 ");
				}else if($scope.notlp == null){
					alert("harus diisi 2");
				}else if($scope.alamat == null){
					alert("harus diisi 3");
				}else{
					$http.post("<?php echo base_url('crud/aksi') ?>", {
						'nama'   : $scope.nama,
						'notelp' : $scope.notlp,
						'alamat' : $scope.alamat,
						'btnName': $scope.btnName
					}
				).success(function(data){
					$scope.nama = null;
					$scope.notlp = null;
					$scope.alamat = null;
					$scope.btnName = "Insert";
					$scope.show_data();
				});
			}
		}



		$scope.show_data = function(){
			$http.get("<?= base_url('crud/data_biodata') ?>")
			.success(function(data){
				$scope.biodatas = data;
			});
		}

		$scope.edit_data = function(id, nama, notelp, alamat){
			$scope.id     = id;
			$scope.nama   = nama;
			$scope.notlp  = notelp;
			$scope.alamat = alamat;
			$scope.btnName = "Update";
			$scope.insert = function(){
				$http.post("<?php echo base_url('crud/aksi') ?>", {
						'id'   : $scope.id,
						'nama' : $scope.nama,
						'notelp': $scope.notlp,
						'alamat': $scope.alamat,
						'btnName': $scope.btnName
				}
			).success(function(data){
				$scope.id    = null;
				$scope.nama  = null;
				$scope.notlp = null;
				$scope.alamat = null;
				$scope.btnName = "Insert";
				$scope.show_data();
			});
			}
		}

		$scope.delete_data = function(id){
			if(confirm("anda ingin mengapus") ) {
				$http.post("<?php echo base_url('crud/delete') ?>", {
						'id' : id //'id' id dari database
				})
				.success(function(data) {
					$scope.show_data();
				});
			}else{
				return false;
			}
		}



		});
</script>

</body>
</html>
