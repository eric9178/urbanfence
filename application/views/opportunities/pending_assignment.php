<!-- <style type="text/css">
::-webkit-scrollbar {
  width: 10px!important;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: lightblue; 
  border-radius: 10px;
}


td.details-control {
    background: url('<?php echo base_url("/assets/images/plus.png") ?>') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url("/assets/images/minus.png") ?>') no-repeat center center;
}
</style> -->
<style type="text/css">


    @media screen and (max-width: 1170px) {
        div#opporTable_wrapper {
            padding-bottom: 3%;
            overflow: auto;
        }
    }

    @media screen and (max-width: 850px) {
        button.width_filter {
            width: 4rem;
        }
    }

    @media screen and (max-width: 767px) {
        button.width_filter {
            width: 6rem;
        }
    }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="" class="breadcrumb--active">Opportunities List</a></div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <!-- BEGIN: Filters -->
    <form id="filterForm">
        <div class="intro-y grid grid-cols-12 p-5 mt-5 gap-2 box">
            <h2 class="col-span-12 font-medium text-base  border-b border-gray-200">Filters</h2>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Job Type</label>
                    <div class="mt-1">
                        <select class="input w-full border" id="job_type">
                            <option value="0">All</option>
                            <option value="1">Fence Repair</option>
                            <option value="2">Gate Repair</option>
                            <option value="3">Fence and Gate Repair</option>
                            <option value="4">New Fence</option>
                            <option value="5">New Gate</option>
                            <option value="6">New Fence and Gate c/w Operator</option>
                            <option value="7">Gate Operator Service</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Oppor. Per Month</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="Oppor_per_month">
                            <option>APR</option>
                            <option>MAY</option>
                            <option>JUN</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Sale Source</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="sale_source">
                            <option value="0">All</option>
                            <option value="1">Returned Customer</option>
                            <option value="2">Yellow Pages</option>
                            <option value="3">Facebook</option>
                            <option value="4">Google Ad</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Status</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="status">
                            <option value="0">All</option>
                            <option value="1">New</option>
                            <option value="2">Assigned</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Sale Rep</label>
                    <div class="mt-1">
                        <select class="select2 w-full" id="sale_rep">
                            <option value="0">All</option>
                            <?php
                            foreach ($users as $user) {
                                echo '<option value="' . $user->id . '">' . $user->username . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Customer</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="customer"/>
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Oppor ID</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="id"/>
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Customer ID</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="customer_id"/>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Date</label>
                    <div class="mt-1">
                        <input data-daterange="true" value="<?php echo date('m/d/Y') . ' - ' . date('m/d/Y'); ?>"
                               class="datepicker input pl-12 border w-full" id="date">
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Job City</label>
                    <div class="mt-1">
                        <input type="text" placeholder="Search" class="input pl-12 border w-full" id="job_city">
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Urgency</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="urgency">
                            <option value="0">All</option>
                            <option value="1">Normal</option>
                            <option value="1">Urgent</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="col-span-12 sm:col-span-6 md:col-span-4 flex items-end">
                <div>
                    <button class="button w-24 mr-1  bg-theme-1 text-white" id="clearFilter">Clear filter</button>
                    <button class="button w-24 mr-1  bg-theme-6 text-white float-right width_filter" id="apply_filter">
                        filter
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- END: Filters -->

    <!-- BEGIN: Datatable -->
    <div class="intro-y box p-5 mt-5" id="table_main_div">
        <table id="opporTable" class="display" style="width:100%;text-align: center; margin-bottom: 5px;">
            <thead>
            <tr>
                <th>Additional Info</th>
                <th>Id</th>
                <th>Customer ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th class="whitespace-no-wrap">Job Type</th>
                <th>Sale Sourse</th>
                <th>Status</th>
                <th>Sales Rep</th>
                <th>Edit</th>
                <th>Create Quote</th>
            </tr>
            </thead>
        </table>

    </div>
    <!-- END: Datatable -->
</div>
<!-- END: Content -->

<script type="text/javascript">
    function format(d) {
        /*console.log(d.JobCity);*/
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; text-alight:center">' +

            '<tr>' +
            '<td>Job City:</td>' +
            '<td>' + d.job_city + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Contact Person:</td>' +
            '<td>' + d.contact_person + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Job Address:</td>' +
            '<td>' + d.job_address + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Job Site:</td>' +
            '<td>' + d.job_site + '.</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Urgency:</td>' +
            '<td>' + d.urgency + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Time:</td>' +
            '<td>' + d.time + '..</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Details:</td>' +
            '<td>' + d.details + '</td>' +
            '</tr>' +
            '</table>';
    }

    $(document).ready(function () {
        var table = $('#opporTable').DataTable({
            "pageLength": 50,
            //"ajax": '<?php echo base_url("Opportunity/get_opportunities");?>',
            "ajax": {
                url: '<?php echo base_url("Opportunity/get_opportunities");?>',
                data: function (data) {
                    data.job_type = $('#job_type').val();
                    data.sale_source = $('#sale_source').val();
                    data.status = $('#status').val();
                    data.sale_rep = $('#sale_rep').val();
                    data.customer = $('#customer').val();
                    data.customer_id = $('#customer_id').val();
                    data.id = $('#id').val();
                    data.date = $('#date').val();
                    data.job_city = $('#job_city').val();
                    data.urgency = $('#urgency').val();
                },
                type: 'GET',
            },
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "id"},
                {"data": "customer_id"},
                {"data": "date"},
                {"data": "customer"},
                // { "data": "jobcity" },
                {"data": "job_type"},
                {"data": "sale_source"},
                {"data": "status"},
                {"data": "sale_rep"},

                {
                    "data": null, render: function (data) {
                        return "<a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a>"
                    }
                },


                {
                    "data": null, render: function (data) {
                        return "<a href='<?php echo base_url('Quotes/add_quote');?>'><i class='fa fa-external-link' aria-hidden='true'></i></a>"
                    }
                }
            ],
            "order": [[0, 'asc']]
        });

        // Add event listener for opening and closing details
        $('#opporTable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
        $('#filterForm').on('submit', function () {
            event.preventDefault();
        });
        $('#apply_filter').click(function () {
            table.ajax.reload(null, false);
        });
        $('#clearFilter').click(function () {
            $('#filterForm').trigger('reset');
            table.ajax.reload(null, false);
        })
    });
</script>