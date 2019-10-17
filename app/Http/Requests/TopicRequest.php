<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
                // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'       => 'required|min:2',
                    'body'        => 'required|min:3',
                    'category_id' => 'required|numeric',
                    'photo' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                };
        }
    }

    public function messages()
    {
        return [
            'photo.mimes' =>'图片必须是 jpeg, bmp, png, gif 格式的图片',
            'photo.dimensions' => '图片的清晰度不够，宽和高需要 208px 以上',
            'title.min' => '标题必须至少两个字符',
            'body.min' => '文章内容必须至少三个字符',
        ];
    }
}










