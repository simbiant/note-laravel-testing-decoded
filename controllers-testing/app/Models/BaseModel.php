<?php
class BaseModel extends Eloquent
{
    public static function shouldReceive()
    {
        $class = get_called_class();
        $repo = "Way\\Storage\\{$class}\\{$class}RepositoryInterface";
        $mock = Mockery::mock($repo);

        App::instance($repo, $mock);

        return call_user_func_array(
            [$mock, 'shouldReceive'],
            func_get_args()
        );
    }
}
