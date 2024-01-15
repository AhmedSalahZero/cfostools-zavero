 <tr class="total-tr">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <b>
                                                {{ __('Total') }}
                                            </b>
                                        </td>

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input data-column-identifier="{{ $year }}" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentTotal[$year] ??0 }}" readonly data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $year }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control   size">

                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order+ 1 ;
                                        @endphp
                                        @endforeach

                                    </tr>
