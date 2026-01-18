  <div class="overflow-x-auto">
      <div class="overflow-x-auto">
          <!-- Desktop Table (hidden on mobile) -->
          <x-dashboard.table.desktop :expenses="$expenses"/>
          <!-- Mobile Cards (visible on mobile only) -->
         <x-dashboard.table.mobile :expenses="$expenses"/>
      </div>
  </div>
