
<!-- thanh toan -->
<div class="cart__wrapper wide">
    <form id="cart__payForm" method="POST" action="pages/contents/handle/pay_handle.php">
    <div class="cart__area row">
        <div class="cart__product col l-7">
            <div class="cart__productWrap">

                <div style="padding: 0" class="w3-container">
                    <table class="w3-table w3-bordered">
                        <tr>
                            <th style="width: 360px;">SẢN PHẨM</th>
                            <th style="width: 110px;">GIÁ</th>
                            <th style="width: 120px;">SỐ LƯỢNG</th>
                        </tr>
                        <?php
                            if(isset($_SESSION['cart'])){
                                foreach ($_SESSION['cart'] as $cart_item) {            
                        ?>
                            <tr id="<?php echo $cart_item['id'] ?>" class="cart__productItem">
                                <td>
                                    <div class="cart__productWR">
                                        <div class="cart__productImg">
                                            <a href="?product-detail=<?php echo $cart_item['cate_slug'] ?>&brand=<?php echo $cart_item['brand_slug'] ?>&id=<?php echo $cart_item['id'] ?>">
                                                <img src="./assets/imgs/admin/upload_img_product/<?php echo $cart_item['thumbnail'] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="cart__productName">
                                            <a href="?product-detail=<?php echo $cart_item['cate_slug'] ?>&brand=<?php echo $cart_item['brand_slug'] ?>&id=<?php echo $cart_item['id'] ?>">
                                                <?php echo $cart_item['name'] ?>
                                            </a>    
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart__productPriceWr">
                                        <span class="cart__productPrice"><?php echo number_format($cart_item['price'],0,"","."); ?> đ</span>      
                                    </div>
                                </td>
                                <td>
                                    <div class="cart__productWR">
                                        <div class="cart__productAmount">
                                            <input type="button" value="-" class="minus_btn quantity_btn">
                                            <input readonly="readonly" type="number" min="1" max="<?php echo $cart_item['quantity_max'] ?>" step="" value="<?php echo $cart_item['quantity'] ?>" class="number_field">
                                            <input type="button" value="+" class="plus_btn quantity_btn">
                                        </div>
                                        <div class="cart__productRemove">
                                            <a href="pages/contents/handle/product_handle.php?delete-to-cart&id=<?php echo $cart_item['id'] ?>">
                                                <i class="far fa-times-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                                }
                            }
                        ?>     
                    </table>
                </div>

                <div class="cart__productBtn">
                    <a href="?product=laptop">
                        <i class="fas fa-arrow-left"></i>
                        <span>Xem sản phẩm khác</span> 
                    </a>
                </div>
            </div>
        </div>
        <div class="cart__pay col l-5">
            <div class="cart__payWrap">
                <!-- <form id="cart__payForm" method="POST" action=""> -->
                    <h4 style="margin-top: 0;" class="cart__payHeader">TẠO PHIẾU THANH TOÁN</h4>
                
                    <div class="area_total">
                        <div class="discountcode">                               
                            <div class="applycode__text_input">
                                <input class="discount_input input_format" maxlength="20" placeholder="Nhập mã giảm giá">
                            </div>
                            <div class="applycode__code" onclick="makeid(12)">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="applycode__button">
                                <button class="input_format" type="button" onclick="money_discount()">Áp dụng</button>
                            </div>                                   
                        </div>
                        <div class="applycode_suc">
                            <i class="fas fa-check-circle"></i>
                            <span>Áp dụng thành công mã giảm giá </span> 
                        </div>
                        <div class="price_provisional">
                            <span class="price_provisional_label">
                                Tạm tính
                                <span>( 3 sản phẩm ):</span>
                            </span>
                            <span class="price_provisional_money"></span>
                        </div>
                        <div class="money_discount" style="display: none;">
                            <span>Mã giảm giá:</span>                                  
                            <span class="money_dis" money_dis = "0" style="color: green"></span>
                        </div>
                        <div class="price_total">
                            <strong class="price_total_label">Tổng tiền:</strong>
                            <span class="price_total_money"></span>
                        </div>
                        
                    </div>

                    <div class="infor_customer">
                        <h4>THÔNG TIN KHÁCH HÀNG:</h4>
                        
                        <div class="sex_customer form_group">
                            <input name="gender" type="radio" value="male"> Anh
                            <input name="gender" type="radio" value="female"> Chị
                            <span class="form_message">vui long nhap</span>                                                     
                        </div>
                        
                        <div id="fill_informWrap">                                    
                            <div class="form_group"> 
                                <input id="fill_inforName" name="name" class="input_format form_control" placeholder="Họ và Tên" type="text" maxlength="50">  
                                <span class="form_message"></span>                                                     
                            </div>

                            <div class="form_group"> 
                                <input id="fill_inforSDT" name="phone"  class="input_format form_control" placeholder="Số điện thoại" type="text" maxlength="50">                                
                                <span class="form_message"></span>                                                     
                            </div>
                        </div>                            
                    </div>

                    <div class="choosegetgoods">
                        <h4>THÔNG TIN NHẬN HÀNG:</h4>
                        
                        <div class="choose_content">
                            <div class="form_group">    
                                <input id="address_input" name="address" class="input_format form_control" type="text" placeholder="Nhập địa chỉ nhận hàng">
                                <span class="form_message"></span>                                                                                               
                            </div>
                            <div class="form_group">
                                <input id="other_request" name="request" class="input_format form_control" type="text" placeholder="Yêu cầu khác (không bắt buộc)">                                                               
                            </div>
                        </div>

                        <div class="deli_unitWr">
                            <div class=" form_group">
                                <div class="deli_unit">
                                    <p>Đơn vị vận chuyển:</p>
                                    <select name="deli_unit" id="deli_unit_sl" onchange="fee_deli()">
                                        <option value="0">Chọn đơn vị vận chuyển</option>
                                        <option value="1">Giao hàng nhanh</option>
                                        <option value="2">Giao hàng tiết kiệm</option>
                                        <option value="3">J&T</option>
                                        <option value="4">Vietnam Post</option>
                                    </select>
                                </div>
                                <span class="form_message" style="text-align: end;"></span>                                                     
                            </div>
                            <div class="fee_deli" style="display: none">
                                <p>Phí giao hàng:</p>
                                <span class="fee_deli_money" fee_deli = "0">0 đ</span>
                            </div>
                        </div>

                        <div class="pay_with">
                            <p>Hình thức thanh toán: </p>
                            <input name="pay_format" type="radio" value="Khi nhận hàng" checked="checked"> Khi nhận hàng
                            <input type="radio" disabled> <span style="color: #ccc;">Bằng thẻ (comingsoon)</span>                        
                        </div>
                    </div>

                    <div class="cart_payBtn">
                        <div class="last_pay">
                            <p>Phải trả:</p>
                            <span class="last_pay_money"></span>
                        </div>
                        <button type="submit" class="input_format">ĐẶT HÀNG</button>
                        
                    </div>
                <!-- </form> -->
            </div>
        </div>  
    </div>
    </form>
</div>