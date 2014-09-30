<?php
//    print_r($node);
?>
<div class="container">
    <div class="row products-header">
        <div class="col-md-12">
            <div class="products-testimonial">
                <img src="<?php print file_create_url($node->field_picture_testomonial['und'][0]['uri']);?>" width="100%" />
            </div>
            <div class="products-caption"></div>
        </div>
    </div>
    <div class="row products-container">
        <div class="col-md-8">
            <h2><?php print $title;?>介绍</h2>
            <div class="products-description">
                <?php print $node->field_product_description['und'][0]['value'];?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="products-details">
                <table>
                    <thead>
                        <tr>
                            <th align="right" colspan="2">功能特色</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>贷款金额：</td>
                            <td align="right"><span>￥ <?php print number_format($node->field_loan_min['und'][0]['value']);?> - ￥ <?php print number_format($node->field_loan_max['und'][0]['value']);?></span></td>
                        </tr>
                        <tr>
                            <td>利率：</td>
                            <td align="right"><span><?php print $node->field_interest_min['und'][0]['value'];?>% - <?php print $node->field_interest_max['und'][0]['value'];?>%</span></td>
                        </tr>
                        <tr>
                            <td>贷款期限：</td>
                            <td align="right"><span><?php print $node->field_tenure_min['und'][0]['value'];?> - <?php print $node->field_tenure_max['und'][0]['value'];?> 个月</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>