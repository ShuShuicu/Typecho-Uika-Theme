<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class TTDF_Router
{
    // 路由列表
    private static $allowedRoutes = [
        'user' => [
            'handler' => 'handleUser',
        ],
    ];

    /**
     * 初始化路由检测
     */
    public static function init()
    {
        $requestPath = self::getRequestPath();

        // 如果匹配到自定义路由，则处理并终止执行
        if (isset(self::$allowedRoutes[$requestPath])) {
            self::handleRoute($requestPath);
        }
        // 否则，Typecho 继续正常流程
    }

    /**
     * 获取当前请求路径
     */
    private static function getRequestPath()
    {
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = trim(parse_url($requestUri, PHP_URL_PATH), '/');
        return $path;
    }
    /**
     * 处理匹配到的路由
     */
    private static function handleRoute($route)
    {
        $response = Typecho_Response::getInstance();
        $response->setStatus(200);

        // 调用对应的处理方法
        $method = self::$allowedRoutes[$route]['handler'];
        if (method_exists(__CLASS__, $method)) {
            self::$method();
        } else {
            $response->setStatus(404);
            echo "404 Route Handler Not Found";
        }
        exit;
    }

    /**
     * 处理路由
     */
    private static function handleUser()
    {
        Uika::GetPage('UserRouter');
    }
}

// 初始化路由检测
TTDF_Router::init();
