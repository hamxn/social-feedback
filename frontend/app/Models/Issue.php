<?php
/**
 * Issue
 *
 * PHP version 7
 *
 * @category Models
 * @package  Issue
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Issue
 *
 * PHP version 7
 *
 * @category Models
 * @package  Issue
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class Issue extends Model
{
    /**
     * Constant STATUS_OPEN
     *
     * @var const STATUS_OPEN
     */
    const STATUS_OPEN = 0;

    /**
     * Constant STATUS_INPROGRESS
     *
     * @var const STATUS_INPROGRESS
     */
    const STATUS_INPROGRESS = 1;

    /**
     * Constant STATUS_RESOLVED
     *
     * @var const STATUS_RESOLVED
     */
    const STATUS_RESOLVED = 2;

    /**
     * Constant STATUS_REJECT
     *
     * @var const STATUS_REJECT
     */
    const STATUS_REJECT = 3;

    /**
     * Constant TOTAL
     *
     * @var const TOTAL
     */
    const TOTAL = -1;

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param string $key to retrieve
     *
     * @return mixed
     */
    public function __get($key)
    {
        $result = $this->getAttribute($key);
        if ($key === 'status_text') {
            $status = $this->getAttribute('status');
            $result = config('myconfig.issue.status.' . $status) ?? '';
        }
        return $result;
    }

    /**
     * Get status's options of table issue
     *
     * @return array status's options of table issue
     */
    public static function statusOptions()
    {
        return config('myconfig.issue.status');
    }

    /**
     * Query to get issue by agent
     *
     * @param object $query to add condition
     *
     * @return object query
     */
    public function scopeMy($query)
    {
        return $query->where('issuer_id', '=', Auth::id());
    }

    /**
     * Query to get completed issue
     *
     * @param object $query to add condition
     *
     * @return object query
     */
    public function scopeCompleted($query)
    {
        return $query->whereIn(
            'status',
            [
                self::STATUS_RESOLVED,
                self::STATUS_REJECT
            ]
        );
    }

    /**
     * Get status's options of table issue
     *
     * @return array status's options of table issue
     */
    public static function statusCompletedOptions()
    {
        return [
            self::STATUS_RESOLVED =>
                config('myconfig.issue.status.' . self::STATUS_RESOLVED),
            self::STATUS_REJECT   =>
                config('myconfig.issue.status.' . self::STATUS_REJECT),
        ];
    }

    /**
     * Get Landing Page Info
     *
     * @return array $res info
     */
    public static function getLandingPageInfo()
    {
        $total_query = self::statisticalQuery(self::TOTAL);
        $open_query = self::statisticalQuery(self::STATUS_OPEN);
        $inprogress_query = self::statisticalQuery(self::STATUS_INPROGRESS);
        $resolved_query = self::statisticalQuery(self::STATUS_RESOLVED);
        $reject_query = self::statisticalQuery(self::STATUS_REJECT);
        $info = $total_query->union($open_query)
            ->union($inprogress_query)
            ->union($resolved_query)
            ->union($reject_query)
            ->get();
        $res = [];
        foreach ($info as $row) {
            $res[$row['prefecture_id']]['name'] = $res[$row['prefecture_id']]['name']
                ?? Prefecture::getPrefNameByPrefId($row['prefecture_id']);
            $res[$row['prefecture_id']]['total'] = $row['total']
                ? $row['total']
                : ($res[$row['prefecture_id']]['total'] ?? 0);
            $res[$row['prefecture_id']]['open'] = $row['open_status']
                ? $row['open_status']
                : ($res[$row['prefecture_id']]['open'] ?? 0);
            $res[$row['prefecture_id']]['inprogress'] = $row['inprogress_status']
                ? $row['inprogress_status']
                : ($res[$row['prefecture_id']]['inprogress'] ?? 0);
            $res[$row['prefecture_id']]['resolved'] = $row['resolved_status']
                ? $row['resolved_status']
                : ($res[$row['prefecture_id']]['resolved'] ?? 0);
            $res[$row['prefecture_id']]['reject'] = $row['reject_status']
                ? $row['reject_status']
                : ($res[$row['prefecture_id']]['reject'] ?? 0);
        }
        return $res;
    }

    /**
     * Get statistical query
     *
     * @param int $type query type
     *
     * @return Builder $query statistical query
     */
    protected static function statisticalQuery($type)
    {
        $total      = '0 as total';
        $open       = '0 as open_status';
        $inprogress = '0 as inprogress_status';
        $resolved   = '0 as resolved_status';
        $reject     = '0 as reject_status';

        switch ($type) {
            case self::STATUS_OPEN:
                $open = 'count(*) as open_status';
                break;
            case self::STATUS_INPROGRESS:
                $inprogress = 'count(*) as inprogress_status';
                break;
            case self::STATUS_RESOLVED:
                $resolved = 'count(*) as resolved_status';
                break;
            case self::STATUS_REJECT:
                $reject = 'count(*) as reject_status';
                break;
            default:
                $total = 'count(*) as total';
                break;
        }
        $select = 'prefecture_id,'
            . $total . ','
            . $open . ','
            . $inprogress . ','
            . $resolved . ','
            . $reject;
        $query = Issue::select(\DB::raw($select));
        if ($type != self::TOTAL) {
            $query->where('status', '=', $type);
        }
        $query->groupBy('prefecture_id');
        return $query;
    }
}
