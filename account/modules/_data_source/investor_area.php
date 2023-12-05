<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="text-capitalize"><span id="greeting">Good morning</span>, <?php echo $account_data["username"] ?>🏆</h4>
                <span>Here's a summary of the current status of your <a href="../" class="fw-bold" target="_blank">Remoratradinghubs</a> trading account.</span>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <?php
    if (isset($_SESSION['feedback'])) {
        $feedback = $_SESSION['feedback'];
        unset($_SESSION['feedback']);
    ?>
        <div class="alert alert-primary alert-dismissible fade show mt-n3" role="alert">
            <i class="mdi mdi-bullseye-arrow me-2"></i>
            <?php echo $feedback ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Account Balance</p>
                                    <h6 class="mb-0 fw-bold">$<?php echo number_format($account_data["account_balance"], 2) ?></h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-dollar font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">My Earnings</p>
                                    <h6 class="mb-0 fw-bold">$<?php echo number_format($account_data["account_earnings"], 2) ?></h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-candles font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Investment Plan</p>
                                    <h6 class="mb-0 fw-bold"><?php echo $account_data["investment_plan"] ?></h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-gift font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Amount Invested</p>
                                    <h6 class="mb-0 fw-bold">$<?php echo number_format($account_data["amount_invested"], 2) ?></h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-scatter-chart font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Pending Deposits</p>
                                    <h6 class="mb-0 fw-bold"><?php echo $pending_deposits ?> Pending</h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-money-withdraw font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Pending Withdrawals</p>
                                    <h6 class="mb-0 fw-bold"><?php echo $pending_withdrawals ?> Pending</h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-money-withdraw font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium"> Total Deposits</p>
                                    <h6 class="mb-0 fw-bold">$<?php echo number_format($total_deposits, 2) ?></h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-receipt font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Total Withdrawals</p>
                                    <h6 class="mb-0 fw-bold">$<?php echo number_format($total_withdrawals, 2) ?></h6>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-xs rounded bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-receipt font-size-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mini-stats-wid border-rounded-13 border-light-primary" style="height: 550px;">
                        <div class="card-body">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container" style="height:100%;width:100%">
                                <div id="analytics-platform-chart-demo" style="height:calc(100% - 32px);width:100%"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                    new TradingView.widget({
                                        "container_id": "analytics-platform-chart-demo",
                                        "width": "100%",
                                        "height": "100%",
                                        "autosize": true,
                                        "symbol": "EUR/USD",
                                        "interval": "D",
                                        "timezone": "exchange",
                                        "theme": "light",
                                        "style": "0",
                                        "withdateranges": true,
                                        "allow_symbol_change": true,
                                        "save_image": false,
                                        "details": true,
                                        "hotlist": true,
                                        "calendar": true,
                                        "locale": "en"
                                    });
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>
    <!-- end row -->
</div> <!-- container-fluid -->

<?php include "investor_modals.php" ?>