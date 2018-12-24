<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('layouts.partials.cart_messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(isset($products) && !empty($products->items)): ?>
            <h1>ZAWARTOŚĆ TWOJEGO KOSZYKA</h1>
            <table class="mt-5">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Zdjęcie podglądowe</th>
                        <th>Rozmiar</th>
                        <th>Cena łączna</th>
                        <th>Cena jednostkowa</th>
                        <th>Ilość</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $products->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size => $single_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <form id="transferForm" method="POST" action="<?php echo e(route('transfer.order')); ?>">
                            <?php echo csrf_field(); ?>
                            <td data-column="Produkt" class="text-uppercase"><a href="<?php echo e(route('product', [$single_product['item']->id, str_slug($single_product['item']->name)])); ?>"><?php echo e($single_product['item']->name); ?></a></td>
                            <td data-column="Zdjęcie podglądowe"><img src="<?php echo e(Voyager::image($single_product['item']->front_image)); ?>" width="100"></td>
                            <td data-column="Rozmiar"><?php echo e($size); ?></td>
                            <td data-column="Cena łączna" id="product<?php echo e($single_product['item']->id); ?><?php echo e($size); ?>"><?php echo e($single_product['price']); ?> zł</td>
                            <td data-column="Cena jednostkowa"><?php echo e($single_product['item']->discount_price ?? $single_product['item']->price); ?> zł</td>
                            <td data-column="Ilość">
                                <input data-url="<?php echo e(route('product.updateCart', [$single_product['item']->id, $size])); ?>" class="quantity-input" style="width: 4em" type="number" value="<?php echo e($single_product['qty']); ?>">
                            </td>
                        </form>
                        <form id="deleteForm" action="<?php echo e(route('product.deleteFromCart', [$single_product['item']->id, $size])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <td data-column="Akcje"><button form="deleteForm" class="btn btn-template" type="submit"><i class="fas fa-trash"></i> </button></td>
                        </form>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h5 name="totalPrice" id="totalPrice">DO ZAPŁATY: <?php echo e($products->totalPrice); ?> zł</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <button form="transferForm" type="submit" class="btn btn-template">REALIZUJ ZAMÓWIENIE</button>
                    </div>
                </div>
            <?php else: ?>
                <h5>KOSZYK JEST PUSTY</h5>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        jQuery(document).ready(function(){
            jQuery('.toast__close').click(function(e){
                e.preventDefault();
                var parent = $(this).parent('.toast');
                parent.fadeOut("slow", function() { $(this).remove(); } );
            });
            <?php if(session()->has('cart_message')): ?>
            $('.sessionMessage').fadeIn('slow', function(){
                $('.sessionMessage').delay(2000).fadeOut();
            });
            <?php endif; ?>

            $('.quantity-input').change(function(){
                var value=$(this).val();
                var url = $(this).attr('data-url');
                $.ajax({
                    type : 'get',
                    dataType: 'json',
                    url  : url,
                    data : {
                        'value':value,
                    },
                    success:function(data) {
                        $('#totalPrice').text('DO ZAPŁATY: ' + Math.round(data.totalPrice * 100) / 100 + " zł");
                        $('#totalQty').text(data.totalQty);
                        $('#product' + data.id + data.size).text(Math.round(data.price * 100) / 100 + " zł" );
                        $('.ajaxMessage').fadeIn('normal', function(){
                            $('.ajaxMessage').delay(1000).fadeOut();
                        });
                    },
                    error:function(data) {
                        console.log(data.error);
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>