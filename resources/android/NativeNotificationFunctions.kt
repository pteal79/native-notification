package com.pteal79.plugins.nativenotification

import android.os.Handler
import android.os.Looper
import androidx.fragment.app.FragmentActivity
import com.nativephp.mobile.bridge.BridgeFunction
import com.nativephp.mobile.bridge.BridgeResponse
import com.nativephp.mobile.core.NativeActionCoordinator
import org.json.JSONObject

object NativeNotificationFunctions {

    class SendNotification(private val activity: FragmentActivity) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            val message = parameters["message"] as? String

            val payload = JSONObject().apply {
                put("message", message)
            }

            Handler(Looper.getMainLooper()).post {
                NativeActionCoordinator.dispatchEvent(
                    activity,
                    "PTeal79\\NativeNotification\\Events\\MobileEvent",
                    payload.toString()
                )
            }

            return BridgeResponse.success(mapOf("dispatched" to true))
        }
    }
}
