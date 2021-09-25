<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NotificationTemplate
 *
 * @property int $id
 * @property string $subject
 * @property string $title
 * @property string $notification_content
 * @property string $mail_content
 * @property string|null $spanish_notification_content
 * @property string|null $spanish_mail_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereMailContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereNotificationContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereSpanishMailContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereSpanishNotificationContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotificationTemplate extends Model
{
    use HasFactory;

    protected $table = 'notification_template';

    protected $fillable = ['subject','title','notification_content','spanish_notification_content','spanish_mail_content','mail_content'];
}
