<div class="row" data-ng-app="glApp" data-ng-controller="MainController">
  <div class="col-sm-6 product-filter-inner">
    <div class="loan-row">
      <div class="filter-title-row clearfix">
        <div class="filter-title">
          需要的贷款额度
        </div>
        <div class="loan-value">
          <span id="loan">￥ {{ settings.minLoan }}</span>
        </div>
      </div>
      <div class="loan-slider-row">
        <div id="loan-slider" gl-slider type="Loan" step="1000" ng-model="userInput.loan"></div>
      </div>
      <div class="range-row clearfix">
        <div class="min-col">￥ {{ settings.minLoan }}</div>
        <div class="max-col">￥ {{ settings.maxLoan }}</div>
      </div>
      <div class="loan-warning">
        <span ng-show="userInput.loan > 1000000">超过此额度的贷款可能需要抵押物</span>&nbsp;
      </div>
    </div>
    <div class="tenure-row">
      <div class="filter-title-row clearfix">
        <div class="filter-title">
          需要的贷款期限
        </div>
        <div class="tenure-value">
          <span id="tenure">{{ settings.minTenure }}</span>
        </div>
      </div>
      <div class="tenure-slider-row">
        <div id="tenure-slider" gl-slider type="Tenure" ng-model="userInput.tenure"></div>
      </div>
      <div class="range-row clearfix">
        <div class="min-col">{{ settings.minTenure }}</div>
        <div class="max-col">{{ settings.maxTenure }}</div>
      </div>
      <div class="loan-warning">
        &nbsp;
      </div>
    </div>
    <div class="result-row clearfix">
      <div class="result-title">
        还款方案
      </div>
      <div class="result-detail">
        <div class="refund-col">
          <div class="name">每月偿还</div>
          <div class="value">￥ 287.69</div>
        </div>
        <div class="rate-col">
          <div class="name">利率</div>
          <div class="value">5.9%</div>
        </div>
        <div class="totle-col">
          <div class="name">总共偿还</div>
          <div class="value">￥ 13,809</div>
        </div>

      </div>
    </div>
  </div>
  <div class="col-sm-6 filtered-product">
    <div class="result-caption">
      <div class="result-title">
        最佳方案：
      </div>
      <div class="result-value">
        中小企业贷款
      </div>
    </div>
    <div class="result-buttons">
      <div class="buttons">
        <a class="button">立即申请</a>
      </div>
      <div class="warning">
        具体数字可能在对您详细评估后有所变动
      </div>
    </div>
  </div>
</div>