import { cookies } from "next/headers";
import { NextResponse, NextRequest } from "next/server";

const protectedRoutes = ["/", "/addons"];
const publicRoutes = ["/auth/login", "/auth/register"];
const pluginManagerRoute = ["/plugin_manager"];

export function middleware(request) {
  // session
  const currentUser = cookies().get("current_user")?.value;
  const user = currentUser ? JSON.parse(currentUser) : null;

  // routes
  const path = request.nextUrl.pathname;
  const isProtectedRoutes = protectedRoutes.includes(path);
  const isPublicRoutes = publicRoutes.includes(path);

  // user belum login
  if (isProtectedRoutes && !user) {
    return NextResponse.redirect(new URL("/auth/login", request.nextUrl));
  }
  // jika sudah login
  if (isPublicRoutes && user) {
    return NextResponse.redirect(new URL("/", request.nextUrl));
  }

  // cek pengguna 
  if (user) {
    const isAdmin = user.role === "admin";
    const isSuperadmin = user?.role === "superadmin";
    const isPluginManager = pluginManagerRoute.includes(path);

    // user bukan admin tidak boleh akses
    if (!(isAdmin || isSuperadmin) && isPluginManager) {
      return NextResponse.redirect(new URL("/404", request.nextUrl));
    }
  }
}
