@extends('layouts.app')

@section('title', 'Income')

@section('content')
<main class="main">
    <div class="d-flex">
        <ol class="breadcrumb flex-fill">
            <li class="breadcrumb-item active">Orders</li>
        </ol>

        <ol class="breadcrumb text-white" style="background-color:#2f353a">
            <li class="breadcrumb-item">
                <i class="fas fa-gem"></i> <span class="px-1">:</span> &#8369;&nbsp;{{ number_format(winnersGemValue(), 2) }}
            </li>
        </ol>
    </div>

    <div class="container-fluid pb-5">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" role="tab-list">
                        <li class="nav-item">
                            <a class="nav-link <?php if(!isset($_GET["view"])) { ?>active<?php } ?>" href="orders.php" style="<?php if(!isset($_GET["view"])) { ?>background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22<?php } else { ?>background-color:rgba(0,0,0,0); color:#0e4d22<?php } ?>"><i class="fas fa-gift"></i> Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET["view"]) && $_GET["view"] == "winners-gem") { ?>active<?php } ?>" href="orders.php?view=winners-gem" style="<?php if(isset($_GET["view"]) && $_GET["view"] == "winners-gem") { ?>background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22<?php } else { ?>background-color:rgba(0,0,0,0); color:#0e4d22<?php } ?>"><i class="fas fa-gem"></i> Winners Gem</a>
                        </li>
                    </ul>

                    <div class="table-responsive">
                        <?php if(!isset($_GET["view"])) { ?>
                        <table class="table table-bordered data-table" style="display:none">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Date &amp; Time Placed</th>
                                <th>Reference</th>
                                <th>Total Amount</th>
                                <th>Total Points Value</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($orders as $order) { ?>
                            <tr>
                                <td><button class="btn btn-success btn-sm view-items" value="<?php echo $order["id"]; ?>" data-reference="<?php echo $order["reference"]; ?>" style="background-color:#0e4d22">View Items</button></td>
                                <td><?php echo $order["date_time_placed"]; ?></td>
                                <td><?php echo $order["reference"]; ?></td>
                                <td><?php echo number_format($order["price"],"2"); ?> <i class="fas fa-gem" style="font-size:0.8em"></i></td>
                                <td><?php echo number_format($order["points_value"],"2"); ?> PV</td>
                                <td class="<?php echo ($order["date_time_completed"]) ? "bg-success" : "bg-warning"; ?>" style="color:#ffffff"><?php echo ($order["date_time_completed"]) ? "Completed<br>" . $order["date_time_completed"] : "Pending"; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } else if(isset($_GET["view"]) && $_GET["view"] == "winners-gem") { ?>
                        <table class="table table-bordered data-table" style="display:none">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Date &amp; Time Requested</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($gem_purchases as $gem_purchase) { ?>
                            <tr>
                                <td><button class="btn btn-success update-proof-of-payment" value="<?php echo $gem_purchase["id"]; ?>" style="background-color:#0e4d22; color:#ffffff">Update Proof of Payment<span style="display:none"><?php echo $gem_purchase["proof_of_payment"]; ?></span></button></td>
                                <td><?php echo $gem_purchase["date_time_requested"]; ?></td>
                                <td><?php echo number_format($gem_purchase["amount"],"2",".",","); ?> <i class="fas fa-gem" style="font-size:0.8em"></i></td>
                                <td>&#8369;&nbsp;<?php echo number_format($gem_purchase["price"],"2",".",","); ?></td>
                                <td class="<?php echo ($gem_purchase["date_time_approved"]) ? "bg-success" : "bg-warning"; ?>" style="color:#ffffff"><?php echo ($gem_purchase["date_time_approved"]) ? "Completed<br>" . $gem_purchase["date_time_approved"] : "Pending"; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
