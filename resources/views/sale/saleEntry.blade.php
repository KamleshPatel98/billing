@extends('layout.masters')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header bg-success">
                <h5>Customer Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="form-label">Date</label><br>
                        <input type="date" id="sale_date" value="{{ date('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Bill No.</label><br>
                        <input type="number"  id="bill_no" value="{{ $billNo }}" readonly class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Customer <span class="text-danger">*</span></label> <a href="{{ route('customer.create') }}" class="p-1">+</a><br>
                        <select  id="customer_id" class="form-control chosen" style="height:20px;">
                            <option value="">Select</option>
                            @foreach ($customers as $row)
                                <option value="{{ $row->id }}">{{ $row->cust_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header bg-success">
                <h5>Sale Item Entry</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="" class="form-label">Item  <span class="text-danger">*</span></label> <a href="{{ route('item.create') }}" class="p-1">+</a><br>
                        <select  id="item_id" class="form-control chosen" style="height:20px;" >
                            <option value="">Select</option>
                            @foreach ($items as $row)
                                <option value="{{ $row->id }}">{{ $row->item_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Unit <span class="text-danger">*</span></label>   <a href="{{ route('unit.create') }}" class="p-1">+</a><br>
                        <select  id="unit_id" class="form-control chosen" style="height:20px;" >
                            <option value="">Select</option>
                            @foreach ($units as $row)
                                <option value="{{ $row->id }}">{{ $row->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Price <span class="text-danger">*</span></label><br>
                        <input type="number"  id="price" value=""  class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Qty <span class="text-danger">*</span></label><br>
                        <input type="number"  id="qty" value=""  class="form-control" onclick="getQty();">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Amount <span class="text-danger">*</span></label><br>
                        <input type="number"  id="totalPrice" value="" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Action</label><br>
                        <button class="btn btn-sm btn-primary" onclick="addItem();">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header bg-success">
                <h5>Sale Item Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SNo.</th>
                                <th>Item Name</th>
                                <th>Unit name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="saleLowertable">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-sm btn-primary" type="submit" onclick="addSaleEntry();">Submit</button>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function getQty(){
            var price=$('#price').val();
            var qty=$('#qty').val();
            var totalPrice=price*qty;
            $('#totalPrice').val(totalPrice);
            //alert(item_id);
        }

        function addItem(){
            var item_id=$('#item_id').val();
            var customer_id=$('#customer_id').val();
            var bill_no=$('#bill_no').val();
            var unit_id=$('#unit_id').val();
            var price=$('#price').val();
            var qty=$('#qty').val();
            var totalPrice=$('#totalPrice').val();
            if(item_id=='' || customer_id=='' || bill_no=='' || unit_id=='' || price=='' || qty=='' || totalPrice==''){
                alert('All field is required!');
                return false;
            }

            $.ajax({
                type: "GET",
                url: "{{ route('storeSaleLowerEntry') }}",
                data: {
                    'item_id':item_id,'customer_id':customer_id,'bill_no':bill_no,'unit_id':unit_id,'price':price,'qty':qty,'totalPrice':totalPrice,
                },
                dataType: "json",
                success: function (response) {
                    if(response==200){
                        getData();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success('Item Added Successfully!');
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.error('Item Is Not Added!');
                    }
                }
            });
        }

        function getData(){
            $.ajax({
                type:"GET",
                url:"{{ route('saleItemEntry.index') }}",
                success:function(data){
                    $("#saleLowertable").html(data);
                }
            });
        }
        getData();

        function addSaleEntry(){
            var sale_date=$('#sale_date').val();
            var customer_id=$('#customer_id').val();
            var bill_no=$('#bill_no').val();

            $.ajax({
                type: "GET",
                url: "{{ route('addSaleEntry') }}",
                data: {
                    'sale_date':sale_date,'customer_id':customer_id,'bill_no':bill_no,
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response==200){
                        alert('Sale Entry Added Successfully!');
                        location.reload();
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.error('Item Is Not Added!');
                    }
                }
            });
        }
    </script>
@endsection