<style>
    div.pager {
        text-align: center;
        margin: 1em 0;
    }

    div.pager span {
        display: inline-block;
        width: 1.8em;
        height: 1.8em;
        line-height: 1.8;
        text-align: center;
        cursor: pointer;
        background: #343a40;
        color: #fff;
        margin-right: 0.5em;
    }

    div.pager span.active {
        background: #ffd116;;
    }

</style>
<div class="panel pad-20">
    <div class="panel-body">
        <div class="row" id="search">
            <div class="col-md-4 form-group">
                <select id="country" class="form-control">
                    <option value="all" disabled selected>Select country</option>
                    <option value="all">All</option>
                    <?php
                    foreach($countries as $country):
                        echo '<option value="'.$country.'">'.$country.'</option>';
                    endforeach;?>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <select id="state" class="form-control">
                    <option value="all" disabled selected>Valid phone numbers</option>
                    <option value="all">All</option>
                    <option>Ok</option>
                    <option>NOk</option>
                </select>
            </div>
            <div class="col-md-4 form-group"></div>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped" id="phoneTable">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>Country Code</th>
            <th>Phone num.</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($customers as $customer):
        echo '<tr class="show-data">';
            echo '<td class="country">'.$customer['country_name'].'</td>';
            echo '<td class="state">'.$customer['state'].'</td>';
            echo '<td>'.$customer['country_code'].'</td>';
            echo '<td>'.$customer['phone'].'</td>';
        echo '</tr>';
        endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function () {
        activatePagination($('#phoneTable'));
        $("#country, #state").on("change", function () {
            var country = $('#country').find("option:selected").val().toLowerCase();
            var state = $('#state').find("option:selected").val().toLowerCase();
            SearchData(country, state)
        });
    });
    function SearchData(country, state) {
        if (country == 'all' && state == 'all') {
            $('#phoneTable tbody tr').show();
            $('#phoneTable tbody tr').addClass('show-data');
        } else {
            $('#phoneTable tbody tr:has(td)').each(function () {
                var rowCountry = $.trim($(this).find('td.country').text()).toLowerCase();
                var rowState = $.trim($(this).find('td.state').text()).toLowerCase();

                if (country != 'all' && state != 'all') {
                    if (rowCountry == country && rowState == state) {
                        $(this).show();
                        $(this).addClass('show-data');
                    } else {
                        $(this).hide();
                        $(this).removeClass('show-data');
                    }
                } else if ($(this).find('td.country').text() != '' || $(this).find('td.country').text() != '') {
                    if (country != 'all') {
                        if (rowCountry == country) {
                            $(this).show();
                            $(this).addClass('show-data');
                        } else {
                            $(this).hide();
                            $(this).removeClass('show-data');
                        }
                    }
                    if (state != 'all') {
                        if (rowState == state) {
                            $(this).show();
                            $(this).addClass('show-data');
                        }
                        else {
                            $(this).hide();
                            $(this).removeClass('show-data');
                        }
                    }
                }
 
            });
        }
        activatePagination($('#phoneTable'));
    }

    function activatePagination($table) {
        $('.pager').remove();
        var currentPage = 0;
        var numPerPage = 10;

        $table.bind('repaginate', function() {
            $table.find('tbody tr.show-data').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr.show-data').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertAfter($table).find('span.page-number:first').addClass('active');
    }
</script>