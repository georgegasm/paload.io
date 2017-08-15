<!DOCTYPE html>
<html>
<?php echo includeStylesheets();?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url("css");?>dashboard.css">
<head>
    <title>Dashboard - paload.io</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <center><span class="navbar-brand brown-text" href="#">paload.io</span></center>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <button type="button" class="btn btn-default col-md-12 brown-button" data-toggle="modal" data-target="#loadNowModal">Load Now!</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default col-md-12 brown-button" data-toggle="modal" data-target="#manageWalletModal">Manage Wallet</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default col-md-12 brown-button" data-toggle="modal" data-target="#payBalancesModal">Pay Balances</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default col-md-12 brown-button" onclick="window.location = '<?php echo base_url();?>';">Logout</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <table id="loadOrderTable" class="display">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Mobile Number</th>
                        <th>Amount</th>
                        <th>Pay via</th>
                        <th>Paid Amount</th>
                        <th>Status</th>
                        <th>Reference Number</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="loadNowModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title brown-text">Load Order</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="input-group col-md-10 col-md-offset-1">
                        <span class="input-group-addon" id="basic-addon1">Pay Via</span>
                        <select class="form-control" aria-describedby="basic-addon1" id="loadNowInput_payvia">
                            <option value="0">Cash</option>
                            <option value="1">Wallet</option>
                        </select>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="input-group col-md-10 col-md-offset-1">
                        <span class="input-group-addon" id="basic-addon1">Amount</span>
                        <input type="text" class="form-control" placeholder="0.0" aria-describedby="basic-addon1" id="loadNowInput_amount">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="input-group col-md-10 col-md-offset-1">
                        <span class="input-group-addon" id="basic-addon1">Mobile Number +(63)</span>
                        <input type="text" class="form-control" placeholder="9xxxxxxxxx" aria-describedby="basic-addon1" id="loadNowInput_mobileNumber">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn btn-default col-md-10 col-md-offset-1 brown-button" id="loadNowModalSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
<div id="manageWalletModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title brown-text">Manage Wallet</h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="input-group col-md-10 col-md-offset-1">
                    <span class="input-group-addon" id="basic-addon1">Balance</span>
                    <input type="text" class="form-control" placeholder="0.0" aria-describedby="basic-addon1" id="ManageWalletInput_balance" readonly>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn btn-default col-md-10 col-md-offset-1 brown-button" id="manageWalletModalSubmit">Top Up Now!</button>
                </div>
                <div id="manageWallet_pendingInputGroups">
                    <h4 class="brown-text">Pending Top Up</h4>
                    <div class="row">
                        <div class="input-group col-md-10 col-md-offset-1">
                            <span class="input-group-addon" id="basic-addon1">Date</span>
                            <input type="text" class="form-control" placeholder="0000-00-00 00:00:00" aria-describedby="basic-addon1" id="ManageWalletInput_date" readonly>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                    <div class="input-group col-md-10 col-md-offset-1">
                        <span class="input-group-addon" id="basic-addon1">Top Up Amount</span>
                        <input type="text" class="form-control" placeholder="0.0" aria-describedby="basic-addon1" id="ManageWalletInput_topUpAmount" readonly>
                    </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="input-group col-md-10 col-md-offset-1">
                            <span class="input-group-addon" id="basic-addon1">Reference Number</span>
                            <input type="text" class="form-control" placeholder="0.0" aria-describedby="basic-addon1" id="ManageWalletInput_referenceNUmber" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
<div id="payBalancesModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title brown-text">Pay Balances</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="input-group col-md-10 col-md-offset-1">
                        <span class="input-group-addon" id="basic-addon1">Upaid Load</span>
                        <select class="form-control" aria-describedby="basic-addon1" id="payBalancesInput_unpaidLoad">
                            <option>Remaining: 0.0 Ref Number: 0</option>
                        </select>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="input-group col-md-10 col-md-offset-1">
                        <span class="input-group-addon" id="basic-addon1">Wallet Balance</span>
                        <input type="text" class="form-control" placeholder="0.0" aria-describedby="basic-addon1" id="payBalancesInput_walletBalance" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn btn-default col-md-10 col-md-offset-1 brown-button" id="payBalancesModalSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loadingModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <center><img src="<?php echo asset_url("img");?>/processing.gif"></center>
    </div>
</div>
</div>
</body>
<?php echo includeScripts();?>
<script type='text/javascript' src="<?php echo asset_url("js");?>dashboard.js"></script>
</html>