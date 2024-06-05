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
                        <input type="number"  id="bill_no" value="{{ $bill_no }}" readonly class="form-control">
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
                    <input type="hidden" id="id">
                    <div class="col-md-2">
                        <label for="" class="form-label">Action</label><br>
                        <button class="btn btn-sm btn-primary"   onclick="addItem();">Add</button>
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
            var id=$('#id').val();
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
            if(id != ''){
                //update item route('purchaseItemEntry.updateItem')
                $.ajax({
                    type: "GET",
                    url: ",
                    data:  {
                        'id':id,'item_id':item_id,'customer_id':customer_id,'bill_no':bill_no,'unit_id':unit_id,'price':price,'qty':qty,'totalPrice':totalPrice,
                    },
                dataType: "json",
                    success: function (response) {
                        if(response==200){
                            getData();
                            // $('#item_id').html('');
                            // $('#customer_id').html('');
                            // $('#bill_no').html('');
                            // $('#unit_id').html('');
                            $('#price').val('');
                            $('#qty').val('');
                            $('#totalPrice').val('');
                            $('#id').val('');
                            alertify.set('notifier','position', 'top-right');
                            alertify.success('Item Updated Successfully!');
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.error('Item Is Not Updated!');
                        }
                    }
                });
            }else{
                //add item
                $.ajax({
                type: "GET",
                url: "{{ route('storePurchaseLowerEntry') }}",
                data: {
                    'item_id':item_id,'customer_id':customer_id,'bill_no':bill_no,'unit_id':unit_id,'price':price,'qty':qty,'totalPrice':totalPrice,
                },
                dataType: "json",
                success: function (response) {
                    if(response==200){
                        getData();
                        // $('#item_id').html('');
                        // $('#customer_id').html('');
                        // $('#bill_no').html('');
                        // $('#unit_id').html('');
                        $('#price').val('');
                        $('#qty').val('');
                        $('#totalPrice').val('');
                        $('#id').val('');
                        alertify.set('notifier','position', 'top-right');
                        alertify.success('Item Added Successfully!');
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.error('Item Is Not Added!');
                    }
                }
            });
            }
        }

        //Fetch Lower Table Data
        function getData(){
            $.ajax({
                type:"GET",
                url:"{{ route('purchase.index') }}",
                success:function(data){
                    $("#saleLowertable").html(data);
                }
            });
        }
        getData();

        //Add Puchase Entry route('addSaleEntry')
        function addSaleEntry(){
            var sale_date=$('#sale_date').val();
            var customer_id=$('#customer_id').val();
            var bill_no=$('#bill_no').val();

            $.ajax({
                type: "GET",
                url: "",
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

        //Edit Item route('saleItemEntry.editItem') 
        $(document).on('click','.edit',function(){
            var id = $(this).val();
            alert(id);
            $.ajax({
                type: "GET",
                url: "",
                data: {
                    'id':id,
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) { 
                        $('#id').val(value['id']);
                        $('#item_id').val(value['item_id']);
                        $('#customer_id').val(value['customer_id']);
                        $('#bill_no').val(value['bill_no']);
                        $('#unit_id').val(value['unit_id']);
                        $('#price').val(value['price']);
                        $('#qty').val(value['qty']);
                        $('#totalPrice').val(value['totalPrice']);
                    });
                    // $('#price').val('');
                    // $('#price').val(response.price);
                }
            });
        })

        //delete Item route('saleItemEntry.deleteItem')
        $(document).on('click','.delete',function(){
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "",
                data: {
                    'id':id,
                },
                dataType: "html",
                success: function (response) {
                    if(response==200){
                        getData();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success('Item Deleted Successfully!');
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.error('Item Is Not Deleted!');
                    }
                }
            });
        })
    </script>
@endsection