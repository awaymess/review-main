<?php
require_once('db/db.php');
require_once('func/mysql.php');
require_once('func/user.php');
$user = USER_INFO();

$this_year = date("Y-01-01");
$this_year = date("Y-m-01");
$this_month = date("Y-m-01");
$today =  date("Y-m-d");

//$start_date = date("Y-m-").'01';
$start_date = date("Y-m-d", strtotime("-22 day"));
$end_date = date("Y-m-d");
$out_date = $start_date . ' - ' . $end_date;

if ($_GET[out_date]) {
    $out_date = $_GET[out_date];
    $ods = explode(" - ", $_GET[out_date]);
    $start_date = $ods[0];
    $end_date = $ods[1];

    $check_sdate = strtotime($start_date);
    $check_edate = strtotime($end_date);

    $datediff = ($check_edate - $check_sdate) / (60 * 60 * 24);
}

$sql_unship = "SELECT 
appointment,
SUM(CASE
    WHEN route = 'BANGKOK' THEN 1
    ELSE 0
END) AS BANGKOK,
SUM(CASE
    WHEN route = 'CENTRAL' THEN 1
    ELSE 0
END) AS CENTRAL,
SUM(CASE
    WHEN route = 'WEST' THEN 1
    ELSE 0
END) AS WEST,
SUM(CASE
    WHEN route = 'EAST' THEN 1
    ELSE 0
END) AS EAST,
SUM(CASE
    WHEN route = 'NORTHEAST' THEN 1
    ELSE 0
END) AS NORTHEAST,
SUM(CASE
    WHEN route = 'NORTH' THEN 1
    ELSE 0
END) AS NORTH,
SUM(CASE
    WHEN route = 'SOUTH' THEN 1
    ELSE 0
END) AS SOUTH,
SUM(CASE
    WHEN route = 'Incorrect_data' THEN 1
    ELSE 0
END) AS Incorrect_data
FROM
bkl2018_.v_do_unship
GROUP BY appointment
ORDER BY appointment;
";
$dataChart_unship = MYSQL_GET_DATA($db, $sql_unship);


$sql_unship_cbm = "SELECT 
appointment,
SUM(CASE
    WHEN route = 'BANGKOK' THEN ttl_cbm
    ELSE 0
END) AS BANGKOK,
SUM(CASE
    WHEN route = 'CENTRAL' THEN ttl_cbm
    ELSE 0
END) AS CENTRAL,
SUM(CASE
    WHEN route = 'WEST' THEN ttl_cbm
    ELSE 0
END) AS WEST,
SUM(CASE
    WHEN route = 'EAST' THEN ttl_cbm
    ELSE 0
END) AS EAST,
SUM(CASE
    WHEN route = 'NORTHEAST' THEN ttl_cbm
    ELSE 0
END) AS NORTHEAST,
SUM(CASE
    WHEN route = 'NORTH' THEN ttl_cbm
    ELSE 0
END) AS NORTH,
SUM(CASE
    WHEN route = 'SOUTH' THEN ttl_cbm
    ELSE 0
END) AS SOUTH
FROM
bkl2018_.v_do_unship
GROUP BY appointment
ORDER BY appointment;
";
$dataChart_unship_cbm = MYSQL_GET_DATA($db, $sql_unship_cbm);

$sql_fix = "SELECT DISTINCT
IFNULL(`DO`.`do_outdate`,
        SLA_AUTO(`DO`.`inv_date`, `DO`.`sla`)) AS `appointment`,
SUM(CASE
    WHEN route = 'BANGKOK' THEN 1
    ELSE 0
END) AS BANGKOK,
SUM(CASE
    WHEN route = 'CENTRAL' THEN 1
    ELSE 0
END) AS CENTRAL,
SUM(CASE
    WHEN route = 'WEST' THEN 1
    ELSE 0
END) AS WEST,
SUM(CASE
    WHEN route = 'EAST' THEN 1
    ELSE 0
END) AS EAST,
SUM(CASE
    WHEN route = 'NORTHEAST' THEN 1
    ELSE 0
END) AS NORTHEAST,
SUM(CASE
    WHEN route = 'NORTH' THEN 1
    ELSE 0
END) AS NORTH,
SUM(CASE
    WHEN route = 'SOUTH' THEN 1
    ELSE 0
END) AS SOUTH
FROM
((`bkl2018_`.`view_do_summary` `DO`
LEFT JOIN `bkl2018_`.`tbl_delivery_detail` `SHN` ON ((`DO`.`do_no` = `SHN`.`do_no`)))
LEFT JOIN `bkl2018_`.`tbl_sale_group` `SG` ON ((`DO`.`sale_group` = `SG`.`sale_group`)))
WHERE
((`SHN`.`status` = 'WAIT DELIVERY')OR (`SHN`.`status` = 'WAIT RELEASE')OR (`SHN`.`status` = 'RELEASE'))
GROUP BY appointment
ORDER BY appointment;
";
$dataChart_fix = MYSQL_GET_DATA($db, $sql_fix);

$sql = "SELECT 
`T`.`qty` AS `qty`,
`T`.`ttl_cbm` AS `ttl_cbm`,
`T`.`province` AS `province`,
`T`.`zone` AS `zone`
FROM
(SELECT 
    SUM(`a`.`qty`) AS `qty`,
        SUM(`a`.`cbm`) AS `ttl_cbm`,
        `a`.`province` AS `province`,
        `c`.`zone` AS `zone`
FROM
    `bkl2018_`.`tbl_do` `a`
LEFT JOIN `bkl2018_`.`tbl_province` `c` ON (`a`.`province` = `c`.`province_th`)
WHERE
    (`a`.`inv_date` between '$start_date' and '$end_date')
GROUP BY `a`.`province` , `c`.`zone`
order by qty desc) `T`
WHERE
(`T`.`zone` IS NOT NULL)
ORDER BY `T`.`qty` desc, `T`.`ttl_cbm` DESC
LIMIT 20;";
// $dataChart = MYSQL_GET_DATA($db, $sql);

$sql_customer = "SELECT
`T`.`qty` AS `qty`,
`T`.`ttl_cbm` AS `ttl_cbm`,
`T`.`customer_name`
/*concat(`T`.`customer_name`,'_',`T`.`province`) AS `customer_name`*/
/* `T`.`customer_name` AS `customer_name` */
FROM
(SELECT
    SUM(`a`.`qty`) AS `qty`,
        SUM(`a`.`cbm`) AS `ttl_cbm`,
        /*`a`.`province` AS `province`,*/
        `a`.`customer_name` AS `customer_name`
FROM `bkl2018_`.`tbl_do` `a`
WHERE
    (`a`.`inv_date` between '$start_date' and '$end_date')
GROUP BY `a`.`customer_name`
order by qty desc) `T`
ORDER BY `T`.`qty` desc, `T`.`ttl_cbm` DESC
LIMIT 20;";

//$dataChart_customer = MYSQL_GET_DATA($db, $sql_customer); ////////////////////////////

$sql = "SELECT 
`T`.`qty` AS `qty`,
`T`.`ttl_cbm` AS `ttl_cbm`,
`T`.`zone` AS `zone`
FROM
(SELECT 
    SUM(`a`.`qty`) AS `qty`,
        SUM(`a`.`cbm`) AS `ttl_cbm`,
        `b`.`zone` AS `zone`
FROM `bkl2018_`.`tbl_do` `a`
LEFT JOIN `bkl2018_`.`tbl_province` `b` 
  ON `a`.`province` = `b`.`province_th`
WHERE
  (`a`.`inv_date` between '$start_date' and '$end_date')
GROUP BY  `b`.`zone`) `T`
WHERE (`T`.`zone` IS NOT NULL)
ORDER BY TTL_CBM DESC";

//echo $sql;
//$dataPie = MYSQL_GET_DATA($db, $sql); ////////////////////////////

// DO
$sql_do = "SELECT 
COUNT(`T`.`do_no`) AS `do_no`,
`T`.`zone` AS `zone`
FROM
(SELECT DISTINCT
    `a`.`do_no` AS `do_no`, `c`.`zone` AS `zone`
FROM
	`bkl2018_`.`tbl_do` `a`
    LEFT JOIN `bkl2018_`.`tbl_province` `c`
    on a.province = c.province_th
WHERE
(`a`.`inv_date` between '$start_date' and '$end_date')) `T`
WHERE (`T`.`zone` IS NOT NULL)
GROUP BY  `T`.`zone`
ORDER BY do_no DESC";
//echo $sql;
// $dataPie2 = MYSQL_GET_DATA($db, $sql_do); ////////////////////////////

// Pareto chart
$sql_pareto = "SELECT
COUNT(`T`.`do_no`) AS `do_no`,
/*`T`.`sale_group` AS `sale_group`*/
`T`.market_type AS `sale_group`
FROM
(SELECT DISTINCT
    `a`.`do_no` AS `do_no`, `a`.`sale_group_name` AS `sale_group`, b.market_type
FROM
	`bkl2018_`.`tbl_do` `a`
    LEFT JOIN
    bkl2018_.tbl_sale_group b
    on a.sale_group = b.sale_group
WHERE
(`a`.`inv_date` between '$start_date' and '$end_date')) `T`
WHERE
(`T`.`sale_group` IS NOT NULL)
GROUP BY  `T`.`market_type`
ORDER BY do_no DESC";

// $dataPareto1 = MYSQL_GET_DATA($db, $sql_pareto); ////////////////////////////

// Pareto chart
$sql_pareto2 = "SELECT
sum(`T`.`cbm`) AS `do_no`,
/*`T`.`sale_group_name` AS `sale_group`,*/
`T`.market_type AS `sale_group`
FROM
(SELECT 
    a.*,b.market_type
FROM
	`bkl2018_`.`tbl_do` `a`
    LEFT JOIN
    bkl2018_.tbl_sale_group b
    on a.sale_group = b.sale_group
WHERE
(`a`.`inv_date` between '$start_date' and '$end_date')) `T`
WHERE
(`T`.`sale_group_name` IS NOT NULL)
GROUP BY  `T`.`market_type`
ORDER BY do_no DESC";

// $dataPareto2 = MYSQL_GET_DATA($db, $sql_pareto2); ////////////////////////////

//get method
$do_date = ($_GET[do_date]) ? $_GET[do_date] : date("Y-m-d");
$model = ($_GET[model]) ? $_GET[model] : "";
$province = ($_GET[province]) ? $_GET[province] : "";
$customer = ($_GET[customer]) ? $_GET[customer] : "";

//set value page header
$page_icon = "icon ion-ios-home-outline";
$page_title = "Dashboard";
$page_intro = '
Delivery Summary Dashboard';
$title = "Home";
include "body/head_demo.php";

?>
<style>
    @media only screen and (max-width: 375px) {

        body {
            font-size: 0.4em;
        }

        #summary {
            font-size: 0.4em !important;
        }


    }
</style>
<style>
    #chart_hyper,
    #chart_electronic,
    #chart_dldup,
    #chart_dldbkk,
    #chartdiv,
    #chartdiv2,
    #chartdiv3,
    #chartdiv_customer,
    #chartPareto1,
    #chartPareto2 {
        width: 100%;
        height: 540px;
    }

    #chart_status,
    #chart_kpi,
    #chart_kpi_pod,
    #chart_cbm,
    #chart_unship,
    #chart_unship_cbm,
    #chart_fix {
        width: 100%;
        height: 560px;
    }

    #chart_bg {
        width: 100%;
        height: 600px;
        display: none;
    }
</style>
<!--
    <div class="br-section-wrapper shadow-base card-body pd-25 bd-0">
        <div class="row">
            <div class="col-12">
                <form id="do_form" action="" method="GET">
                    <div class="mg-t-20 mg-md-t-0">

                    </div>
                </form>
            </div>
        </div>
    </div>
-->
<div class="br-pagebody">
    <div class="card shadow-base bd-0 pd-15 mg-t-20">
        <div class="d-md-flex justify-content-between pd-15">
            <div>
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">How Progressed Our Delivery</h6>

                <!--<p>Range <?php echo $datediff; ?> Days — <?php echo $start_date; ?> to <?php echo $end_date; ?></p>-->
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                        </div>
                    </div>
                    <form id="do_form" action="" method="GET">
                        <input style="width:180px" readonly type="text" id="out_date" class="form-control" value="<?php echo $out_date; ?>" name="out_date" data-disable-touch-keyboard>
                    </form>
                </div>
            </div>

            <?php
            $sql = "SELECT
                    COUNT(do_no) as DO_NO,
                    SUM(CASE
                        WHEN T.status = 'DONE' THEN 1
                        ELSE 0
                    END) AS DONE,
                    SUM(CASE
                        WHEN T.status = 'DELIVERED' THEN 1
                        ELSE 0
                    END) AS DELIVERED,
                    SUM(CASE
                        WHEN T.status = 'DELIVERING' THEN 1
                        ELSE 0
                    END) AS DELIVERING,
                    SUM(CASE
                        WHEN T.status = 'WAIT DELIVERY' or T.status = 'WAIT RELEASE' or T.status = 'RELEASE'  THEN 1
                        ELSE 0
                    END) AS WAIT_DELIVERY,
                    SUM(CASE
                        WHEN T.status = 'WAIT PLAN' OR T.Status IS NULL
                        THEN 1
                        ELSE 0
                    END) AS WAIT_PLAN,
                    SUM(CASE
                        WHEN T.status = 'CANCEL'
                        THEN 1
                        ELSE 0
                    END) AS CANCEL,
                    COUNT(T.do_no) as total
                    FROM
                    (SELECT DISTINCT
                        A.do_no,
                            A.customer_no,
                            A.customer_name,
                            A.inv_date,
                            A.location,
                            A.province,
                            A.sale_group,
                            A.sale_group_name,
                            IFNULL(UPPER(B.status),'WAIT PLAN') AS status
                    FROM
                        bkl2018_.tbl_do A
                    LEFT JOIN bkl2018_.tbl_delivery_detail B ON A.do_no = B.do_no
                    WHERE
                        A.do_no IN (SELECT DISTINCT
                                do_no
                            FROM
                                bkl2018_.tbl_delivery_rec)
                            AND A.inv_date between '$start_date' and '$end_date'

                    UNION SELECT DISTINCT
                        A.do_no,
                            A.customer_no,
                            A.customer_name,
                            A.inv_date,
                            A.location,
                            A.province,
                            A.sale_group,
                            A.sale_group_name,
                            A.category AS status
                    FROM
                        bkl2018_.tbl_do_no A
                    WHERE A.category = 'CANCEL'
                    AND A.inv_date between '$start_date' and '$end_date') T;";
            $data_status = MYSQL_GET_DATA($db, $sql)[0];

            $sql_cbm = "SELECT 
                    sum(cbm) AS total_cbm,
                    SUM(CASE
                        WHEN T.status = 'DONE' THEN cbm ELSE 0
                    END) AS DONE,
                    SUM(CASE
                        WHEN T.status = 'DELIVERED' THEN cbm ELSE 0
                    END) AS DELIVERED,
                    SUM(CASE
                        WHEN T.status = 'DELIVERING' THEN cbm ELSE 0
                    END) AS DELIVERING,
                    SUM(CASE
                        WHEN T.status = 'WAIT DELIVERY' or T.status = 'WAIT RELEASE' or T.status = 'RELEASE'  THEN cbm ELSE 0
                    END) AS WAIT_DELIVERY,
                    SUM(CASE
                        WHEN
                            T.status = 'WAIT PLAN' OR T.Status IS NULL
                        THEN cbm ELSE 0
                    END) AS WAIT_PLAN,
                    SUM(CASE
                        WHEN T.status = 'CANCEL' THEN cbm ELSE 0
                    END) AS CANCEL,
                    sum(cbm) AS total
                FROM
                    (SELECT DISTINCT
                            A.do_no,
                            IFNULL(SUM(A.cbm),0) as cbm,
                            IFNULL(UPPER(B.status), 'WAIT PLAN') AS status
                    FROM
                        bkl2018_.tbl_do A
                    LEFT JOIN bkl2018_.tbl_delivery_detail B ON A.do_no = B.do_no
                    WHERE
                        A.do_no IN (SELECT DISTINCT
                                do_no
                            FROM
                                bkl2018_.tbl_delivery_rec)
                            AND A.inv_date BETWEEN  '$start_date' and '$end_date'
                    GROUP BY 
                            A.do_no,
                            B.status
                        UNION
                        SELECT DISTINCT
                            A.do_no,
                            IFNULL(SUM(A.cbm),0) as cbm,
                            A.category AS status
                    FROM
                        bkl2018_.tbl_do_no A
                    WHERE
                        A.category = 'CANCEL'
                            AND A.inv_date BETWEEN  '$start_date' and '$end_date'
                    GROUP BY A.do_no,
                            A.category
                    ) T";
            $data_cbm = MYSQL_GET_DATA($db, $sql_cbm)[0];
            ?>

            <div class="d-sm-flex" id="summary">
                <div>
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Total DO</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[DO_NO]; ?></h4>
                    <span class="tx-14 tx-dark tx-roboto"><?php echo number_format($data_cbm[total_cbm], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-dark tx-roboto"><?php echo number_format($data_status[DO_NO] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% Upload</span>
                </div>
                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">POD</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[DONE]; ?></h4>
                    <span class="tx-14 tx-success tx-roboto"><?php echo number_format($data_cbm[DONE], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-success tx-roboto"><?php echo number_format($data_status[DONE] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% Done</span>
                </div>
                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">ORDER DELIVERED</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[DELIVERED]; ?></h4>
                    <span class="tx-14 tx-primary tx-roboto"><?php echo number_format($data_cbm[DELIVERED], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-primary tx-roboto"><?php echo number_format($data_status[DELIVERED] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% Wait POD</span>
                </div>
                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">ON DELIVERING</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[DELIVERING]; ?></h4>
                    <span class="tx-14 tx-info tx-roboto"><?php echo number_format($data_cbm[DELIVERING], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-info tx-roboto"><?php echo number_format($data_status[DELIVERING] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% On going</span>
                </div>
                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">FIXED APPOINTMENT</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[WAIT_DELIVERY]; ?></h4>
                    <span class="tx-14 tx-warning tx-roboto"><?php echo number_format($data_cbm[WAIT_DELIVERY], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-warning tx-roboto"><?php echo number_format($data_status[WAIT_DELIVERY] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% Appointment</span>
                </div>

                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">ON PROCESS</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[WAIT_PLAN]; ?></h4>
                    <span class="tx-14 tx-danger tx-roboto"><?php echo number_format($data_cbm[WAIT_PLAN], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-danger tx-roboto"><?php echo number_format($data_status[WAIT_PLAN] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% On process</span>
                </div>

                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">CANCEL</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0"><?php echo $data_status[CANCEL]; ?></h4>
                    <span class="tx-14 tx-secondary tx-roboto"><?php echo number_format($data_cbm[CANCEL], 2, '.', ''); ?> CBM</span><br>
                    <span class="tx-12 tx-secondary tx-roboto"><?php echo number_format($data_status[CANCEL] / $data_status[DO_NO] * 100, 2, '.', ''); ?>% cancel</span>
                </div>
            </div><!-- d-flex -->
        </div>

        <h3>Unship monitor by DO (งานยังไม่ออกใบคุม)
            <!-- <?php echo $user->name; ?> -->
        </h3>
        <div class="d-md-flex justify-content-between pd-5">
            <div id="chart_unship"></div>
        </div>

        <h3>Unship monitor by CBM (งานยังไม่ออกใบคุม)</h3>
        <div class="d-md-flex justify-content-between pd-5">
            <div id="chart_unship_cbm"></div>
        </div>


        <h3>Order Follow up monitor (งานออกใบคุมแล้ว แต่ยังไม่ Picking)</h3>
        <div class="d-md-flex justify-content-between pd-5">
            <div id="chart_fix"></div>
        </div>

    </div><!-- row -->
</div><!-- br-pagebody -->


</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<!-- MODAL VIEW SHIPPING NOTE -->
<div id="modalChange" class="modal effect-scale" style="">
    <div class="modal-dialog modal-dialog-centered" style="max-width:90%;" role="document">
        <div class="modal-content bd-0 tx-14">

            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Detail</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body pd-25">
                <div id="ajax_data">

                </div>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div>

<?php include "body/footer.php"; ?>
</div><!-- br-pagebody -->
</div><!-- br-mainpanel -->

<!-- ########## END: MAIN PANEL ########## -->
<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!--
    <script src="../js/pnotify.custom.min.js"></script>
    <script src="../js/bracket.js?<?php echo filemtime('../js/bracket.js'); ?>"></script>
-->
<script src="../js/bracket.js?<?php echo filemtime('../js/bracket.js'); ?>"></script>

<script src="../lib/moment/min/moment.min.js"></script>
<script src="../lib/peity/jquery.peity.min.js"></script>
<script src="../js/ResizeSensor.js"></script>
<script src="../js/bootstrap-datepicker.min.js"></script>
<script src="../js/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script>
    function cache_clear() {
        window.location.reload(true);
    }

    $(document).ready(function() {
        if (Modernizr.touch) {
            // Disable keyboard by adding readonly attribute to field
            $('[data-disable-touch-keyboard]').attr('readonly', 'readonly');
            // Add field value via JavaScript
        }
    });
</script>

<script>
    var tableDO;
    $(function() {
        'use strict';
        $('.br-pagetitle').hide();

        $('#out_date').daterangepicker({
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            $('#out_date').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
            $("#do_form").submit();
        });

        $('.applyBtn').on('click', function() {
            //alert($('#out_date').val());
        });

        $("#table_search").on("keyup search input paste cut", function() {
            tableDO.search(this.value).draw();
        });
    });
</script>

<!-- AJAX -->
<script>
    function getDataUnship(name, date) {
        // $("#modalChange").modal('show');
        console.log(name);
        console.log(date);
        $.ajax({
            method: "GET",
            url: "ajax/get_do_unship.php",
            data: {
                name: name,
                date: date
            },
            cache: false,
            success: function(result) {
                console.log(result);
                $('#ajax_data').html(result);
                $("#modalChange").modal('show');
            }
        });
    }

    function getDataFix(name, date) {
        // $("#modalChange").modal('show');
        console.log(name);
        console.log(date);
        $.ajax({
            method: "GET",
            url: "ajax/get_do_Fixed.php",
            data: {
                name: name,
                date: date
            },
            cache: false,
            success: function(result) {
                console.log(result);
                $('#ajax_data').html(result);
                $("#modalChange").modal('show');
            }
        });
    }

    function getData1(name, date) {
        // $("#modalChange").modal('show');
        console.log(name);
        console.log(date);
        $.ajax({
            method: "GET",
            url: "ajax/get_do_data.php",
            data: {
                name: name,
                date: date
            },
            cache: false,
            success: function(result) {
                console.log(result);
                $('#ajax_data').html(result);
                $("#modalChange").modal('show');
            }
        });
    }

    function getData2(name, date, div) {
        // $("#modalChange").modal('show');
        console.log('Name:' + name + 'Date:' + date + 'Div:' + div);
        $.ajax({
            method: "GET",
            url: "ajax/get_do_data_market.php",
            data: {
                name: name,
                date: date,
                div: div
            },
            cache: false,
            success: function(result) {
                $('#ajax_data').html(result);
                $("#modalChange").modal('show');
            }
        });
    }

    function getData3(name, date) {
        // $("#modalChange").modal('show');
        $.ajax({
            method: "GET",
            url: "ajax/get_do_kpi.php",
            data: {
                name: name,
                date: date
            },
            cache: false,
            success: function(result) {
                $('#ajax_data').html(result);
                $("#modalChange").modal('show');
            }
        });
    }
</script>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/dataviz.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<!-- ------------------------------------------------------------------------------------------------ -->
<script>
    function plotStackedChartUnship(dataChart, type, div) {
        am4core.ready(function() {

            // Themes begin
            // am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create(div, am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();

            // Add data
            chart.data = dataChart;

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = type;
            //    categoryAxis.renderer.grid.template.location = 0;
            //    categoryAxis.renderer.labels.template.horizontalCenter = "right";
            //    categoryAxis.renderer.labels.template.verticalCenter = "middle";
            //    categoryAxis.renderer.labels.template.rotation = 270;

            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = -45;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.minHeight = 110;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inside = false;
            valueAxis.renderer.labels.template.disabled = false;
            valueAxis.min = 0;


            chart.colors.list = [
                am4core.color("#f16745"),
                am4core.color("#ffc65d"),
                am4core.color("#7bc8a4"),
                am4core.color("#4cc3d9"),
                am4core.color("#93648d"),
                am4core.color("#fffe83"),
                am4core.color("#ffbfbf")
            ];


            // chart.colors.step = 9;


            // Create series
            function createSeries(field, name) {

                // Set up series
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.name = name;
                series.dataFields.valueY = field;
                series.dataFields.categoryX = type;
                series.sequencedInterpolation = true;

                series.yAxis = valueAxis;

                // Make it stacked
                series.stacked = true;

                // Configure columns
                series.columns.template.width = am4core.percent(60);
                series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

                // Add label
                var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                labelBullet.label.text = "{valueY}";
                labelBullet.locationY = 0.5;
                labelBullet.label.hideOversized = true;


                series.columns.template.events.on("hit", function(ev) {
                    //alert("clicked on " + name + " Date " + ev.target.dataItem.categories.categoryX);
                    var date = ev.target.dataItem.categories.categoryX
                    getDataUnship(name, date);
                    // alert("Route:"+name+"  Appointment:"+date);
                    //type
                }, this);

                return series;
            }

            createSeries("BANGKOK", "BANGKOK");
            createSeries("CENTRAL", "CENTRAL");
            createSeries("WEST", "WEST");
            createSeries("EAST", "EAST");
            createSeries("NORTHEAST", "NORTHEAST");
            createSeries("NORTH", "NORTH");
            createSeries("SOUTH", "SOUTH");
            createSeries("Incorrect_data", "Incorrect_data");

            chart.legend = new am4charts.Legend();

        });
    };

    function plotStackedChartFixed(dataChart, type, div) {
        am4core.ready(function() {

            // Themes begin
            // am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create(div, am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();

            // Add data
            chart.data = dataChart;

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = type;
            //    categoryAxis.renderer.grid.template.location = 0;
            //    categoryAxis.renderer.labels.template.horizontalCenter = "right";
            //    categoryAxis.renderer.labels.template.verticalCenter = "middle";
            //    categoryAxis.renderer.labels.template.rotation = 270;

            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = -45;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.minHeight = 110;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inside = false;
            valueAxis.renderer.labels.template.disabled = false;
            valueAxis.min = 0;


            chart.colors.list = [
                am4core.color("#f16745"),
                am4core.color("#ffc65d"),
                am4core.color("#7bc8a4"),
                am4core.color("#4cc3d9"),
                am4core.color("#93648d"),
                am4core.color("#fffe83"),
                am4core.color("#ffbfbf")
            ];


            // chart.colors.step = 9;


            // Create series
            function createSeries(field, name) {

                // Set up series
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.name = name;
                series.dataFields.valueY = field;
                series.dataFields.categoryX = type;
                series.sequencedInterpolation = true;

                series.yAxis = valueAxis;

                // Make it stacked
                series.stacked = true;

                // Configure columns
                series.columns.template.width = am4core.percent(60);
                series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

                // Add label
                var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                labelBullet.label.text = "{valueY}";
                labelBullet.locationY = 0.5;
                labelBullet.label.hideOversized = true;


                series.columns.template.events.on("hit", function(ev) {
                    //alert("clicked on " + name + " Date " + ev.target.dataItem.categories.categoryX);
                    var date = ev.target.dataItem.categories.categoryX
                    getDataFix(name, date);
                    // alert("Route:"+name+"  Appointment:"+date);
                    //type
                }, this);

                return series;
            }

            createSeries("BANGKOK", "BANGKOK");
            createSeries("CENTRAL", "CENTRAL");
            createSeries("WEST", "WEST");
            createSeries("EAST", "EAST");
            createSeries("NORTHEAST", "NORTHEAST");
            createSeries("NORTH", "NORTH");
            createSeries("SOUTH", "SOUTH");

            chart.legend = new am4charts.Legend();

        });
    };

    var data_unship = <?php echo json_encode($dataChart_unship); ?>;
    plotStackedChartUnship(data_unship, 'appointment', 'chart_unship');


    var data_unship_cbm = <?php echo json_encode($dataChart_unship_cbm); ?>;
    plotStackedChartUnship(data_unship_cbm, 'appointment', 'chart_unship_cbm');

    var data_fix = <?php echo json_encode($dataChart_fix); ?>;
    plotStackedChartFixed(data_fix, 'appointment', 'chart_fix');
</script>

<!-- ------------------------------------------------------------------------------------------------ -->

</body>

</html>