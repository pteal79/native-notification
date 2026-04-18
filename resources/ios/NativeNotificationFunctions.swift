import Foundation

enum NativeNotificationFunctions {

    class SendNotification: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            let message = parameters["message"] as? String

            let payload: [String: Any] = ["message": message as Any]

            LaravelBridge.shared.send?(
                "PTeal79\\NativeNotification\\Events\\MobileEvent",
                payload
            )

            return BridgeResponse.success(data: ["dispatched": true])
        }
    }
}
