<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\Topic;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();

        // 通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));
    }

    public function creating(Reply $reply)
    {
        // 净化回复 content 字段，处理 XSS 安全问题
        $reply->content = clean($reply->content, 'user_topic_body');
    }


    // 删除回复减少回复数
    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }

}
