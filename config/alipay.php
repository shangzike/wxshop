<?php
return [
		//应用ID,您的APPID。
		'app_id' => "2016092500595054",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAvWMI2ktMBKeN68GSYQkm47dya2lBlcdF1D9Z95u7pkckz494W3kKO64BwKJY7RsuMhToy057X2fyoSUmeJL3sFSd/Rf/eFi1ryunZQmkc/B6UifBg+NPKR0Qg1Zqk0sin9TyyPBqsxUyp4zT6AFl2f5DJ+CZxIqMyzeZjHJRgam82PqsG2ctmVaKjCmD0R27MR4Wul6BRFhvdPOBT85kZyFh6OcG/YaTllwn9gw6rtgxPDE5Lf4JYunm1Fh8f+dE3+0uRpJSxhQVgZUMUIkRm7Kr4ANV8cv56MuJ/2kdOksxZcZBO799oJnJv/2SUcAUrqoAfpwAWkGDF73Wh7uy/wIDAQABAoIBACX95vm7ny1T24GO3GmA539I/rgTbme4iQaSCt9EK3mozfahZlibSHU+a/WT29j82eCMF0MppFA4TxEKndQUT4HdB7CNDt+6k//m9vaq34WumSs/9G8bu3aY8QYX4NtZeEGt+2JZ8F2qg/Xep2fkV+VKP3iRcuddj+74YWIuULF83d9fB0eIuAQEcwRpg4m4OuEn0Mx/k4e3PPk4N64qFeN/pqCdVheXtJeN6t5n5Mp9vRbxN6d35w5L41iQUM4ftxHbeZFsjgY/p7xnLXbQ4aHtoG494jOHn5Be5tP5BE/F6La2Ld//W2kILN8Jm1w44BbwZpIcohMMsf5P+O3d1kECgYEA7ZL0/FX/wMlTLSizHyfyGQ5EXz865IvmxKh9Rcul1kdeyXO6r3470cL5M8HfGXHaPGx9+qGQrwBNP9CtFfI80buLWeI4LBwfC3itcqg4xWeF5g50IZ8uSnfwXcS/7KAB/k/F4Cxtbqljrucod7ZiSt5e0UEnW8thVJSwZfOiRZ8CgYEAzBNRmIKsToThcZV04BcOX+JsUr7gFRJt4EyVrpHQHJwUQljIl4Dkhl9NpKdlwD138BX4Fg16QLyOBC39MiA47Gw+Pu0LR7s8NcmaPXUEcezN9LrAXOUCw2Ze/sOhfioLWLuiKV268mR6PV3vP0uziZkjm3TFn61Bt3qLOZel1qECgYAkGDC6acJ6otvNP6K/OA1zOxSuN+gVsx+zfznRMdiXTq6bAsc5RH+IJgxAjdL8hay3g3A8dPGLdQtHh8fUTsJoxwqr9E++e+NHleUcR2ygqVLRmh6QwSOCUuilBnB2XfUPk0UoAvf5WSj4+MvQLFiQsWpMdo6pRqQZ+qE2TCa6VwKBgQCAi3atKzpf5yGeizboZH2Adj4nTOYXP9mIHJV4NY6yRroYJJaNn/nSjjt5CJx2IAHpb90p/ulP17VY+qLvLQ7OFUyMFIIzd8PwWYHXTlsza6c7jVrX6MT50gTqUs3pi5BEH0SA6/Jy9kltWDr4UrXPaW/dXwuQjfDEIuOJrnUeoQKBgETvJQ+GpwQhVuIvRSmhcQZkmI0yGEu7ZTnqlXibmIct8dMtvI0vWRiBDIe7sYuGQj6b4dJwpwIDKFmstPYUwwd9Fmix9dX3K2kTSUE3eHt2JTWp/02AYcdXSKLDgDyEesO90sgVMIdvwlcTGsMUgj4TTrM91MBei91Za4yICfwk",

		
		//异步通知地址
		'notify_url' => "http://wxshop.com/pay/notify",
		
		//同步跳转
		'return_url' => "http://wxshop.com/pay/return",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5lciTYFSeKTurBsrDcrfDmidAA189vGG4N7q7km7C85Pz7LYlLnYQL2kXxuvLFIH2LJMwWh5UbhzhFBOIy/oASCoU1knwJfnfLgxIHOXCncvrdwUQFbEiMOXbgOVGPpfWT495o6n0Tvd+HVwcZBpLd0BE7+AM4IarqAIwbcbhpOfgkP0p+lJt39t7xydRRsXutrkF7RiuEk+UrTw1LmUpDm2nAR4V9ykp+LM8Q/17+2lxSXFfEqPDR/xp40OKL7x+Gf3WlmE1OF05HyaG2iAW8nFQKa/XH22DlFbt6tKiKyB0S3mKCKsiAQMW6swztiLz+DAmKuZaShbRGO2/D9q/QIDAQAB",

        "mode"=>'dev'
];