<?

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Khôi phục tài khoản người dùng.
     *
     * @param int $id
     * @return bool
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function restoreUser($id)
    {
        // Khôi phục tài khoản người dùng
        $user = User::onlyTrashed()->findOrFail($id);
        return $user->restore();
    }
    /**
     * Xóa tài khoản người dùng vĩnh viễn.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserForever($id)
    {
        // Xóa tài khoản người dùng vĩnh viễn
        $user = User::onlyTrashed()->findOrFail($id);
        return $user->forceDelete();
    }
    /**
     * Lấy danh sách người dùng đã bị xóa.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getDeletedUsers()
    {
        return User::onlyTrashed()->paginate(10);
    }
    public function destroy($id)
    {
        // Gọi phương thức softDelete từ repository 
        $this->userRepository->softDelete($id);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
    public function deletedUsers()
    {
        // Lấy danh sách các người dùng đã xóa (giả sử là những người dùng có trường 'deleted_at' không null)
        $users = User::onlyTrashed()->paginate(10);

        return view('user-deleted', compact('users'));
    }
}
