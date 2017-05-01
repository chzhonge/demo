<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers;
use DB;
use Log;
use App\Models\Question;

class DatabaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            DB::connection()->getPdo();
            Question::all()->count();
            return $next($request);
        } catch (\PDOException $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 200, 'error' => 'PDO Drivers尚未安裝或資料庫問題，請查看Lumen.log。']);
        }
    }
}