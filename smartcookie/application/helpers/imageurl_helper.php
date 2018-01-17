<?php
/**
 * SmartCookie
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	SmartCookie
 * @author	Sudhir Deshmukh
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('imageurl'))
{
	/**
	 * imageurl
	 *
	 * To check the available image url
	 * 
	 * type=sclogo or avatar else sorry image not available is shown
	   img_loc is the path to image in  /Assets/images/ folder
	 * 
	 */
	function imageurl($value,$type='',$img=''){
			//$logoUrl=@get_headers(base_url('/Assets/images/sp/profile/'.$value));
			if($img=='sp_profile'){
				$path='sp/profile/';
			}elseif($img=='product'){
				$path='sp/productimage/';
			}elseif($img=='spqr'){
				$path='sp/coupon_qr/';
			}else{
				$path='';
			}
			
			$logoUrl=@get_headers(base_url('/Assets/images/'.$path.$value));
			$tlogoUrl=@get_headers('http://tsmartcookies.bpsi.us/'.$value);
			$slogoUrl=@get_headers('http://www.smartcookie.in/core/'.$value);
			if($logoUrl[0] == 'HTTP/1.1 200 OK' && $value!='new-product.jpg' && $value!='' ){
				$logoexist=base_url('/Assets/images/'.$path.$value);
			}elseif($tlogoUrl[0] == 'HTTP/1.1 200 OK' && $value!=''){
				$logoexist='http://tsmartcookies.bpsi.us/'.$value;
			}elseif($slogoUrl[0] == 'HTTP/1.1 200 OK' && $value!=''){
				$logoexist='http://www.smartcookie.in/core/'.$value;
			}else{
				if($type=='sclogo'){
					$logoexist=base_url('/Assets/images/sp/profile/newlogo.png');
				}elseif($type=='avatar'){
					$logoexist=base_url('/Assets/images/avatar/avatar_2x.png');
				}else{
					$logoexist=base_url('/Assets/images/sp/profile/imgnotavl.png');
				}				
			}
			return $logoexist;
		}
}
		