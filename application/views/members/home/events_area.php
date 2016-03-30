<?
    //echo '<pre>'; print_r($ticker); echo '</pre>';
?>
<script type="text/javascript">
$(function() {

  // NOTE: $.tablesorter.theme.bootstrap is ALREADY INCLUDED in the jquery.tablesorter.widgets.js
  // file; it is included here to show how you can modify the default classes
  $.tablesorter.themes.bootstrap = {
    // these classes are added to the table. To see other table classes available,
    // look here: http://getbootstrap.com/css/#tables
    table        : 'table table-bordered table-striped',
    caption      : 'caption',
    // header class names
    header       : 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
    sortNone     : '',
    sortAsc      : '',
    sortDesc     : '',
    active       : '', // applied when column is sorted
    hover        : '', // custom css required - a defined bootstrap style may not override other classes
    // icon class names
    icons        : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
    iconSortNone : 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
    iconSortAsc  : 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
    iconSortDesc : 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
    filterRow    : '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
    footerRow    : '',
    footerCells  : '',
    even         : '', // even row zebra striping
    odd          : ''  // odd row zebra striping
  };

  // call the tablesorter plugin and apply the uitheme widget
  $("table").tablesorter({
    // this will apply the bootstrap theme if "uitheme" widget is included
    // the widgetOptions.uitheme is no longer required to be set
    theme : "bootstrap",

    widthFixed: true,

    headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

    // widget code contained in the jquery.tablesorter.widgets.js file
    // use the zebra stripe widget if you plan on hiding any rows (filter widget)
    widgets : [ "uitheme", "filter", "zebra" ],

    widgetOptions : {
      // using the default zebra striping class name, so it actually isn't included in the theme variable above
      // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
      zebra : ["even", "odd"],

      // reset filters button
      filter_reset : ".reset",

      // extra css class name (string or array) added to the filter element (input or select)
      filter_cssFilter: "form-control",

      // set the uitheme widget to use the bootstrap theme class names
      // this is no longer required, if theme is set
      // ,uitheme : "bootstrap"

    }
  })
  .tablesorterPager({

    // target the pager markup - see the HTML block below
    container: $(".ts-pager"),

    // target the pager page select dropdown - choose a page
    cssGoto  : ".pagenum",

    // remove rows from the table to speed up the sort of large tables.
    // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
    removeRows: false,

    // output string - default is '{page}/{totalPages}';
    // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

  });

});
</script>
<script>
$(document).ready(function(){
    $('table').tablesorter({
        widgets        : ['zebra', 'columns'],
        usNumberFormat : false,
        sortReset      : true,
        sortRestart    : true
    });
});
</script>
<div class="row">
    <div class="col-md-12" style="min-height:600px;">
            <h3 class="title green2 title-box text-center">Surrounding Rides</h3>
            <table id="surroundingRideListing" class="display">
                <thead>
                    <tr>
                        <th class="center">&nbsp;</th>
                        <th class="left">Departure</th>
                        <th class="left">Arrival</th>
                        <th class="left">Driver</th>
                        <th class="center">Seats Left</th>
                        <th class="center">Per Seat</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="center">&nbsp;</th>
                        <th class="left">Departure</th>
                        <th class="left">Arrival</th>
                        <th class="left">Driver</th>
                        <th class="center">Seats Left</th>
                        <th class="center">Per Seat</th>
                    </tr>
                    <tr>
                      <th colspan="6" class="ts-pager form-horizontal">
                        <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                        <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                        <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                        <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                        <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                        <select class="pagesize input-mini" title="Select page size">
                          <option selected="selected" value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="40">40</option>
                        </select>
                        <select class="pagenum input-mini" title="Select page number"></select>
                      </th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if(isset($ticker) && count($ticker)>0) {
                        for($i = 0; $i < count($ticker); $i++) {
                            $class = ($i%2==0) ? 'odd' : 'even';
                            $start = $ticker[$i]["DepartShort"];
                            $finish = $ticker[$i]["ArriveShort"];
                            $price = $ticker[$i]["Price"];
                            $passengers = $ticker[$i]["Passengers"];
                            $id = $ticker[$i]["Ride_ID"];
                            $driver = $ticker[$i]["Driver_Name"];

                            if($price === NULL) 
                                { $price = 'N/A'; }

                            if($passengers === NULL ||
                                    $passengers === '') {
                                $passengers = 'N/A';
                            }
                        ?>
                            <tr class="green-odd ride_ticker" value="<?=$id?>">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q='.$id?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td><?=$start;?></td>
                                <td><?=$finish;?></td>
                                <td><?=$driver?></td>
                                <td class="center"><?=$passengers?></td>
                                <td class="center"><?='$'.$price ?>&nbsp;</td>
                            </tr>
                        <?php 
                                }
                            }
                        ?>
                        <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                        <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                    <tr class="green-odd ride_ticker">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q=';?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td>TEST</td>
                                <td class="center">TEST</td>
                                <td class="center"><?='$0.00' ?>&nbsp;</td>
                            </tr>
                </tbody>
            </table>
            <input type="hidden" id="url" value="<?=base_url()?>"><br><br>
        <a href="<?=site_url('main/postride');?>" class="btn btn-primary text-uppercase" style="width: 100%;"><i class="fa fa-road"></i>&nbsp;Post Your Ride</a>
            <br><br>
        </div>
    </div>
</div>