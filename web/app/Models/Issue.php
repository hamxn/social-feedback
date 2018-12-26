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
use App\Chain\Model\Concerns\Chain;

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
    use Chain;

    /**
     * @var array $fillable
     */
    protected $fillable =
        ['id', 'title', 'prefecture_id', 'content', 'address', 'issuer_id', 'created_at', 'updated_at', 'status', 'image_path', 'image_hash'];

    /**
     * @var bool $incrementing
     */
    public $incrementing = false;

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
     * Get status's options of table issue
     *
     * @param int $current_status
     *
     * @return array status's options of table issue
     */
    public static function statusOptionsForAgent($current_status)
    {
        if ($current_status == self::STATUS_RESOLVED || $current_status == self::STATUS_REJECT) {
            return [
                $current_status =>
                    config('myconfig.issue.status.' . $current_status)
            ];
        }
        return [
            self::STATUS_INPROGRESS =>
                config('myconfig.issue.status.' . self::STATUS_INPROGRESS),
            self::STATUS_RESOLVED =>
                config('myconfig.issue.status.' . self::STATUS_RESOLVED),
            self::STATUS_REJECT   =>
                config('myconfig.issue.status.' . self::STATUS_REJECT),
        ];
    }

    /**
     * Query to get issue by user
     *
     * @param object $query to add condition
     *
     * @return object query
     */
    public function my()
    {
        $this->where(['issuer_id' => Auth::id()]);
        return $this;
    }

    /**
     * Query to get issue by agent
     *
     * @param object $query to add condition
     *
     * @return object query
     */
    public function agent()
    {
        $this->where(['prefecture_id' => Auth::user()->prefecture_id]);
        return $this;
    }

    /**
     * Query to get completed issue
     *
     * @param object $query to add condition
     *
     * @return object query
     */
    public function completed()
    {
        $this->where([
            'or' => [
                ['status' => self::STATUS_RESOLVED],
                ['status' => self::STATUS_REJECT],
            ]
        ]);
        return $this;
    }

    /**
     * Query to get uncompleted issue
     *
     * @param object $query to add condition
     *
     * @return object query
     */
    public function uncompleted()
    {
        $this->where([
            'or' => [
                ['status' => self::STATUS_OPEN],
                ['status' => self::STATUS_INPROGRESS],
            ]
        ]);
        return $this;
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
    public function getLandingPageInfo()
    {
        $all = $this->get();
        $res = [];
        foreach ($all as $issue) {
            $res[$issue->prefecture_id]['name'] = $res[$issue->prefecture_id]['name']
                ?? Prefecture::getPrefNameByPrefId($issue->prefecture_id);
            $res[$issue->prefecture_id]['total'] = isset($res[$issue->prefecture_id]['total'])
                ? $res[$issue->prefecture_id]['total'] + 1 : 1;
            if ($issue->status == self::STATUS_OPEN) {
                $res[$issue->prefecture_id]['open'] = isset($res[$issue->prefecture_id]['open'])
                ? $res[$issue->prefecture_id]['open'] + 1 : 1;
            } else {
                $res[$issue->prefecture_id]['open'] = $res[$issue->prefecture_id]['open'] ?? 0;
            }

            if ($issue->status == self::STATUS_INPROGRESS) {
                $res[$issue->prefecture_id]['inprogress'] = isset($res[$issue->prefecture_id]['inprogress'])
                ? $res[$issue->prefecture_id]['inprogress'] + 1 : 1;
            } else {
                $res[$issue->prefecture_id]['inprogress'] = $res[$issue->prefecture_id]['inprogress'] ?? 0;
            }

            if ($issue->status == self::STATUS_RESOLVED) {
                $res[$issue->prefecture_id]['resolved'] = isset($res[$issue->prefecture_id]['resolved'])
                ? $res[$issue->prefecture_id]['resolved'] + 1 : 1;
            } else {
                $res[$issue->prefecture_id]['resolved'] = $res[$issue->prefecture_id]['resolved'] ?? 0;
            }

            if ($issue->status == self::STATUS_REJECT) {
                $res[$issue->prefecture_id]['reject'] = isset($res[$issue->prefecture_id]['reject'])
                ? $res[$issue->prefecture_id]['reject'] + 1 : 1;
            } else {
                $res[$issue->prefecture_id]['reject'] = $res[$issue->prefecture_id]['reject'] ?? 0;
            }
        }
        return $res;
    }

    /**
     * Get path
     *
     * @return string
     */
    public static function getPath()
    {
        return 'complaint';
    }

    /**
     * Get Chain class
     *
     * @return string
     */
    protected function getChainClass()
    {
        return 'org.healthsystem.complaint';
    }
}
